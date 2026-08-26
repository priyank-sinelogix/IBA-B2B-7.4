<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Company;
use App\Models\LedgerEntry;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\ShipmentTrackingEvent;
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
        $shipments = $query->latest('status_updated_at')->paginate(15);
        $companies = Company::with('currency')->orderBy('name')->get();

        return view('admin.shipments.index', compact('shipments', 'companies'));
    }

    public function show(Shipment $shipment)
    {
        $shipment->load(['company.currency', 'order', 'trackingEvents']);
        return view('admin.shipments.show', compact('shipment'));
    }

    public function create()
    {
        $shipment = new Shipment();
        $companies = Company::with('currency')->orderBy('name')->get();
        $orders = Order::orderBy('order_no')->get();
        return view('admin.shipments.form', compact('shipment', 'companies', 'orders'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['status_updated_at'] = now();
        $shipment = Shipment::create($data);

        ShipmentTrackingEvent::create([
            'shipment_id' => $shipment->id,
            'status' => $shipment->status,
            'location' => $shipment->origin,
            'remarks' => 'Shipment created',
            'event_at' => now(),
        ]);

        $this->syncShippingCharge($shipment);

        AuditLog::record('shipment.created', $shipment, null, $shipment->only('awb_number', 'status'));

        return redirect('/admin/shipments')->with('success', 'Shipment created.');
    }

    public function edit(Shipment $shipment)
    {
        $companies = Company::with('currency')->orderBy('name')->get();
        $orders = Order::orderBy('order_no')->get();
        $shipment->load('trackingEvents');
        return view('admin.shipments.form', compact('shipment', 'companies', 'orders'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $data = $this->validated($request, $shipment->id);
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

        $this->syncShippingCharge($shipment);

        return redirect('/admin/shipments')->with('success', 'Shipment updated.');
    }

    public function destroy(Shipment $shipment)
    {
        // Reverse any shipping charge already billed to the client before the
        // shipment record itself goes away.
        $this->syncShippingCharge($shipment, 0.0);

        AuditLog::record('shipment.deleted', $shipment, $shipment->only('awb_number'), null);
        $shipment->delete();

        return back()->with('success', 'Shipment deleted.');
    }

    /**
     * Keeps the client's ledger balance in sync with this shipment's shipping
     * price. Ledger entries are immutable (see LedgerController::destroy), so
     * instead of editing a past entry we post an invoice/credit_note for the
     * *difference* between what's already been charged for this shipment and
     * what should now be charged — this also cleanly handles price removal
     * (full reversal) and shipment deletion (pass $desiredPrice = 0).
     */
    private function syncShippingCharge(Shipment $shipment, ?float $desiredPrice = null): void
    {
        $desiredPrice = round($desiredPrice ?? (float) ($shipment->shipping_price ?? 0), 2);

        $alreadyCharged = round(
            (float) LedgerEntry::where('shipment_id', $shipment->id)->where('type', 'invoice')->sum('amount')
            - (float) LedgerEntry::where('shipment_id', $shipment->id)->where('type', 'credit_note')->sum('amount'),
            2
        );

        $delta = round($desiredPrice - $alreadyCharged, 2);
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
                    ? 'Shipping charge — shipment '.$shipment->awb_number
                    : 'Shipping charge adjustment — shipment '.$shipment->awb_number,
            ]);

            $company->update(['current_balance' => $newBalance]);
        });

        AuditLog::record('shipment.shipping_charge_synced', $shipment, null, ['delta' => $delta]);
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'company_id' => 'required|exists:companies,id',
            'order_id' => 'nullable|exists:orders,id',
            'awb_number' => 'required|string|max:100',
            'carrier' => 'required|string|max:100',
            'origin' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'shipping_price' => 'nullable|numeric|min:0',
            'status' => 'required|in:booked,in_transit,arrived_at_port,delivered',
        ]);
    }
}
