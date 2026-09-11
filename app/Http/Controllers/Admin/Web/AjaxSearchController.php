<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Order;
use App\Models\Sample;
use App\Support\VmsOrderMatcher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AjaxSearchController extends Controller
{
    private const PER_PAGE = 20;

    public function search(Request $request, string $type): JsonResponse
    {
        $q = trim((string) $request->get('q', ''));
        $page = max(1, (int) $request->get('page', 1));

        if ($type === 'companies') {
            $query = Company::query()->with('currency')->orderBy('name');
        } elseif ($type === 'samples') {
            $query = Sample::query()->orderBy('style_name');
        } elseif ($type === 'orders') {
            $query = Order::query()->orderBy('order_no');
        } else {
            $query = null;
        }

        if (!$query) {
            return response()->json(['results' => [], 'pagination' => ['more' => false]]);
        }

        if ($type === 'samples' && $request->boolean('approved_only')) {
            $query->where('status', 'approved');
        }

        if ($q !== '') {
            $query->where(function ($w) use ($type, $q) {
                if ($type === 'companies') {
                    $w->where('name', 'like', "%{$q}%")->orWhere('code', 'like', "%{$q}%");
                } elseif ($type === 'samples') {
                    $w->where('style_name', 'like', "%{$q}%")->orWhere('sample_code', 'like', "%{$q}%");
                } elseif ($type === 'orders') {
                    $w->where('order_no', 'like', "%{$q}%")->orWhere('style_name', 'like', "%{$q}%");
                }
            });
        }

        $total = (clone $query)->count();
        $items = $query->forPage($page, self::PER_PAGE)->get();

        $results = $items->map(function ($item) use ($type) {
            if ($type === 'companies') {
                return [
                    'id' => $item->id,
                    'text' => $item->name,
                    'currency_code' => optional($item->currency)->code,
                    'currency_symbol' => optional($item->currency)->symbol ?? '₹',
                ];
            }
            if ($type === 'samples') {
                return [
                    'id' => $item->id,
                    'text' => $item->sample_code.' — '.$item->style_name,
                    'fabric' => $item->fabric,
                    'colour' => $item->color,
                ];
            }
            return ['id' => $item->id, 'text' => $item->order_no.' — '.$item->style_name];
        });

        return response()->json([
            'results' => $results,
            'pagination' => ['more' => $page * self::PER_PAGE < $total],
        ]);
    }

    /**
     * Searchable "VMS Order" dropdown for the Shipment form — distinct VMS
     * order IDs found against the selected company's own generated SKUs.
     */
    public function vmsOrders(Request $request): JsonResponse
    {
        $companyId = (int) $request->get('company_id');
        $q = trim((string) $request->get('q', ''));

        if (!$companyId) {
            return response()->json(['results' => [], 'pagination' => ['more' => false]]);
        }

        $orderIds = VmsOrderMatcher::ordersForCompany($companyId, $q);

        $results = $orderIds->take(self::PER_PAGE)->map(function ($orderid) {
            return ['id' => $orderid, 'text' => $orderid];
        })->values();

        return response()->json([
            'results' => $results,
            'pagination' => ['more' => false],
        ]);
    }

    /**
     * The SKUs (of the selected company) that belong to a given VMS order —
     * used to render the Shipment form's "which SKUs are in this shipment"
     * checkbox list.
     */
    public function vmsOrderSkus(Request $request): JsonResponse
    {
        $companyId = (int) $request->get('company_id');
        $orderid = trim((string) $request->get('orderid', ''));

        if (!$companyId || $orderid === '') {
            return response()->json(['skus' => []]);
        }

        $rows = VmsOrderMatcher::skusForCompanyOrder($companyId, $orderid)->map(function ($row) {
            $row->status_label = VmsOrderMatcher::statusLabel($row->status);

            return $row;
        });

        return response()->json(['skus' => $rows->values()]);
    }
}
