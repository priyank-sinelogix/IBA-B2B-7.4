<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Company;
use App\Models\LedgerEntry;
use App\Models\SamplePricing;
use App\Models\Shipment;
use App\Models\ShipmentTrackingEvent;
use App\Support\VmsOrderMatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Shipment::with('company.currency');
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->get('company_id'));
        }
        if ($request->filled('search')) {
            $term = '%'.$request->get('search').'%';
            $query->where(function ($q) use ($term) {
                $q->where('awb_number', 'like', $term)
                    ->orWhere('carrier', 'like', $term)
                    ->orWhere('destination', 'like', $term);
            });
        }
        $shipments = $query->latest('status_updated_at')->paginate($this->perPage($request));
        $companies = Company::with('currency')->orderBy('name')->get();

        return view('admin.shipments.index', compact('shipments', 'companies'));
    }

    public function show(Shipment $shipment)
    {
        $shipment->load(['company.currency', 'skus', 'trackingEvents']);
        return view('admin.shipments.show', compact('shipment'));
    }

    public function create()
    {
        $shipment = new Shipment();
        return view('admin.shipments.form', compact('shipment'))->with('orderSkuRows', collect());
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $skuIds = $data['sku_ids'] ?? [];
        unset($data['sku_ids']);
        $data['status_updated_at'] = now();
        $shipment = Shipment::create($data);
        $shipment->skus()->sync($this->skuSyncData($shipment->company_id, $shipment->vms_orderid, $skuIds));

        ShipmentTrackingEvent::create([
            'shipment_id' => $shipment->id,
            'status' => $shipment->status,
            'location' => $shipment->origin,
            'remarks' => 'Shipment created',
            'event_at' => now(),
        ]);

        $this->syncShipmentInvoice($shipment);

        AuditLog::record('shipment.created', $shipment, null, $shipment->only('awb_number', 'status'));

        return redirect('/admin/shipments')->with('success', 'Shipment created.');
    }

    public function edit(Shipment $shipment)
    {
        $shipment->load(['company.currency', 'skus', 'trackingEvents']);
        $orderSkuRows = $shipment->vms_orderid
            ? VmsOrderMatcher::skusForCompanyOrder($shipment->company_id, $shipment->vms_orderid)
            : collect();

        return view('admin.shipments.form', compact('shipment', 'orderSkuRows'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $data = $this->validated($request, $shipment->id);
        $skuIds = $data['sku_ids'] ?? [];
        unset($data['sku_ids']);
        $before = $shipment->only('status');

        if ($before['status'] !== $data['status']) {
            $data['status_updated_at'] = now();
            ShipmentTrackingEvent::create([
                'shipment_id' => $shipment->id,
                'status' => $data['status'],
                'location' => $request->input('event_location'),
                'remarks' => $request->input('event_remarks'),
                'event_at' => now(),
            ]);
            AuditLog::record('shipment.status_changed', $shipment, $before, ['status' => $data['status']]);
        }

        $shipment->update($data);
        $shipment->skus()->sync($this->skuSyncData($shipment->company_id, $shipment->vms_orderid, $skuIds));

        $this->syncShipmentInvoice($shipment);

        return redirect('/admin/shipments')->with('success', 'Shipment updated.');
    }

    public function destroy(Shipment $shipment)
    {
        // Reverse any invoice already billed to the client before the
        // shipment record itself goes away.
        $this->syncShipmentInvoice($shipment, 0.0);

        AuditLog::record('shipment.deleted', $shipment, $shipment->only('awb_number'), null);
        $shipment->delete();

        return back()->with('success', 'Shipment deleted.');
    }

    /**
     * Builds the belongsToMany sync array with each SKU's qty as pivot data —
     * always re-read fresh from VMS (never trusted from the submitted form),
     * since VMS's order qty is the source of truth, not something an admin
     * should be able to type over.
     */
    private function skuSyncData(int $companyId, ?string $vmsOrderid, array $skuIds): array
    {
        if (empty($skuIds) || !$vmsOrderid) {
            return [];
        }

        $qtyBySkuId = VmsOrderMatcher::skusForCompanyOrder($companyId, $vmsOrderid)
            ->keyBy('sku_id')
            ->map(function ($row) { return (int) $row->qty; });

        $sync = [];
        foreach ($skuIds as $skuId) {
            $sync[$skuId] = ['qty' => $qtyBySkuId->get($skuId, 0)];
        }

        return $sync;
    }

    /**
     * Keeps the client's ledger balance in sync with this shipment's total
     * charge — product value (each tagged SKU's qty × its Sample Pricing
     * rate) plus the shipping price. Ledger entries are immutable (see
     * LedgerController::destroy), so instead of editing a past entry we post
     * an invoice/credit_note for the *difference* between what's already
     * been charged for this shipment and what should now be charged — this
     * also cleanly handles price removal (full reversal) and shipment
     * deletion (pass $overrideTotal = 0).
     */
    private function syncShipmentInvoice(Shipment $shipment, ?float $overrideTotal = null): void
    {
        if ($overrideTotal !== null) {
            $desiredTotal = round($overrideTotal, 2);
        } else {
            $shipment->load('skus');
            $productValue = $shipment->skus->sum(function ($sku) {
                return SamplePricing::unitPriceForSample($sku->sample_id) * (int) ($sku->pivot->qty ?? 0);
            });
            $desiredTotal = round($productValue + (float) ($shipment->shipping_price ?? 0), 2);
        }

        $alreadyCharged = round(
            (float) LedgerEntry::where('shipment_id', $shipment->id)->where('type', 'invoice')->sum('amount')
            - (float) LedgerEntry::where('shipment_id', $shipment->id)->where('type', 'credit_note')->sum('amount'),
            2
        );

        $delta = round($desiredTotal - $alreadyCharged, 2);
        if ($delta === 0.0) {
            return;
        }

        DB::transaction(function () use ($shipment, $delta) {
            $company = Company::lockForUpdate()->findOrFail($shipment->company_id);
            $type = $delta > 0 ? 'invoice' : 'credit_note';
            $newBalance = (float) $company->current_balance + $delta;

            LedgerEntry::create([
                'company_id' => $company->id,
                'shipment_id' => $shipment->id,
                'order_id' => $shipment->order_id,
                'type' => $type,
                'reference_no' => $shipment->awb_number,
                'amount' => abs($delta),
                'balance_after' => $newBalance,
                'description' => $type === 'invoice'
                    ? 'Shipment invoice (product + shipping) — shipment '.$shipment->awb_number
                    : 'Shipment invoice adjustment — shipment '.$shipment->awb_number,
            ]);

            $company->update(['current_balance' => $newBalance]);
        });

        AuditLog::record('shipment.invoice_synced', $shipment, null, ['delta' => $delta]);
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'company_id' => 'required|exists:companies,id',
            'vms_orderid' => 'nullable|string|max:100',
            'sku_ids' => 'nullable|array',
            'sku_ids.*' => 'integer|exists:skus,id',
            'awb_number' => 'required|string|max:100',
            'carrier' => 'required|string|max:100',
            'origin' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'shipping_price' => 'nullable|numeric|min:0',
            'status' => 'required|in:booked,in_transit,arrived_at_port,delivered',
        ]);
    }
}
