<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Company;
use App\Models\Order;
use App\Models\OrderStageLog;
use App\Models\Sample;
use App\Models\Sku;
use App\Support\VmsOrderMatcher;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderController extends Controller
{
    private array $stages = ['cutting', 'sewing', 'qc_inspection', 'packing', 'dispatched'];

    /**
     * Orders are now sourced live from VMS: every SKU we've generated is
     * matched against vms_selldata and the matching rows are shown as the
     * order list — nothing is fetched-and-saved locally, so this always
     * reflects VMS as of "right now".
     */
    public function index(Request $request)
    {
        $skuQuery = Sku::with('sample.company')->whereHas('sample');
        if ($request->filled('company_id')) {
            $skuQuery->whereHas('sample', function ($q) use ($request) {
                $q->where('company_id', $request->get('company_id'));
            });
        }
        $skusByCode = $skuQuery->get()->keyBy('sku_code');
        $vmsRows = VmsOrderMatcher::matchSkus($skusByCode->keys());

        $rows = $vmsRows->map(function ($vmsRow) use ($skusByCode) {
            $sku = $skusByCode->get($vmsRow->sku);

            return (object) [
                'company' => optional($sku)->sample->company ?? null,
                'sample' => optional($sku)->sample,
                'sku_code' => $vmsRow->sku,
                'orderid' => $vmsRow->orderid,
                'qty' => $vmsRow->qty,
                'size' => $vmsRow->size,
                'status' => $vmsRow->sendformaking,
                'order_date' => $vmsRow->create_date,
                'dispatch_date' => $vmsRow->dispatch_date,
            ];
        });

        if ($request->filled('search')) {
            $term = mb_strtolower($request->get('search'));
            $rows = $rows->filter(function ($row) use ($term) {
                return str_contains(mb_strtolower($row->sku_code ?? ''), $term)
                    || str_contains(mb_strtolower((string) $row->orderid), $term)
                    || str_contains(mb_strtolower(optional($row->company)->name ?? ''), $term)
                    || str_contains(mb_strtolower(optional($row->sample)->style_name ?? ''), $term);
            })->values();
        }

        $page = (int) $request->get('page', 1);
        $perPage = $this->perPage($request);
        $orders = new LengthAwarePaginator(
            $rows->forPage($page, $perPage)->values(),
            $rows->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $selectedCompany = $request->filled('company_id') ? Company::find($request->get('company_id')) : null;

        return view('admin.orders.index', compact('orders', 'selectedCompany'));
    }

    public function show(Order $order)
    {
        $order->load(['company.currency', 'sample.skus', 'stageLogs.order', 'shipments']);
        $vmsMatches = $order->vmsMatches();
        return view('admin.orders.show', compact('order', 'vmsMatches'));
    }

    public function create()
    {
        $order = new Order();
        return view('admin.orders.form', compact('order'))
            ->with('stages', $this->stages);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $order = Order::create($data);

        OrderStageLog::create([
            'order_id' => $order->id,
            'stage' => $order->current_stage,
            'changed_by' => $request->user()->id,
            'changed_at' => now(),
        ]);

        AuditLog::record('order.created', $order, null, $order->only('order_no', 'current_stage'));

        return redirect('/admin/orders')->with('success', 'Order created.');
    }

    public function edit(Order $order)
    {
        $order->load(['company', 'sample', 'stageLogs']);
        return view('admin.orders.form', compact('order'))
            ->with('stages', $this->stages);
    }

    public function update(Request $request, Order $order)
    {
        $data = $this->validated($request, $order->id);
        $before = $order->only('current_stage');

        $order->update($data);

        if ($before['current_stage'] !== $order->current_stage) {
            OrderStageLog::create([
                'order_id' => $order->id,
                'stage' => $order->current_stage,
                'changed_by' => $request->user()->id,
                'changed_at' => now(),
            ]);
            AuditLog::record('order.stage_changed', $order, $before, $order->only('current_stage'));
        }

        return redirect('/admin/orders')->with('success', 'Order updated.');
    }

    public function destroy(Order $order)
    {
        AuditLog::record('order.deleted', $order, $order->only('order_no'), null);
        $order->delete();

        return back()->with('success', 'Order deleted.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'company_id' => 'required|exists:companies,id',
            'sample_id' => 'nullable|exists:samples,id',
            'order_no' => 'required|string|max:100|unique:orders,order_no'.($ignoreId ? ",$ignoreId" : ''),
            'style_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'current_stage' => 'required|in:'.implode(',', $this->stages),
            'eta' => 'nullable|date',
        ]);
    }
}
