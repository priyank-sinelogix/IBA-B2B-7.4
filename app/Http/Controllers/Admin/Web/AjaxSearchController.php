<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Order;
use App\Models\Sample;
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
}
