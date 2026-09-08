<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Sku;
use App\Support\VmsOrderMatcher;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderWebController extends Controller
{
    /**
     * Client's own orders, sourced live from VMS — matched against every SKU
     * generated for this client's samples. Same approach as the admin order
     * list, just scoped to the logged-in user's own company.
     */
    public function index(Request $request)
    {
        $companyId = $request->user()->company_id;

        $skusByCode = Sku::with('sample')
            ->whereHas('sample', function ($q) use ($companyId) {
                $q->where('company_id', $companyId);
            })
            ->get()
            ->keyBy('sku_code');

        $vmsRows = VmsOrderMatcher::matchSkus($skusByCode->keys());

        $rows = $vmsRows->map(function ($vmsRow) use ($skusByCode) {
            $sku = $skusByCode->get($vmsRow->sku);

            return (object) [
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

        $page = (int) $request->get('page', 1);
        $perPage = 15;
        $orders = new LengthAwarePaginator(
            $rows->forPage($page, $perPage)->values(),
            $rows->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('orders.index', compact('orders'));
    }
}
