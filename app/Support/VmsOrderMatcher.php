<?php

namespace App\Support;

use App\Models\Sku;
use App\Models\VmsSelldata;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Shared read-only lookup against the VMS server's vms_selldata table.
 * Never throws — returns an empty collection if there's nothing to match
 * or the VMS server can't be reached, so callers don't need their own
 * try/catch around every lookup.
 */
class VmsOrderMatcher
{
    // sendformaking codes that mean "already shipped out of production".
    private const DISPATCHED_CODES = ['D', 'R'];

    public static function matchSkus(Collection $skuCodes): Collection
    {
        if ($skuCodes->isEmpty()) {
            return collect();
        }

        try {
            return VmsSelldata::whereIn('sku', $skuCodes)->latest('create_date')->get();
        } catch (\Throwable $e) {
            Log::warning('VMS SKU match lookup failed: '.$e->getMessage());

            return collect();
        }
    }

    /**
     * How many distinct VMS orders (grouped by orderid) are not yet dispatched,
     * across the given SKU codes.
     */
    public static function activeOrderCount(Collection $skuCodes): int
    {
        return self::matchSkus($skuCodes)
            ->whereNotIn('sendformaking', self::DISPATCHED_CODES)
            ->pluck('orderid')
            ->filter()
            ->unique()
            ->count();
    }

    /**
     * Total distinct VMS orders (grouped by orderid) across the given SKU
     * codes, regardless of status — powers the "Active Orders" dashboard stat.
     */
    public static function orderCount(Collection $skuCodes): int
    {
        return self::matchSkus($skuCodes)
            ->pluck('orderid')
            ->filter()
            ->unique()
            ->count();
    }

    /**
     * Latest distinct VMS orders (grouped by orderid) across the given SKU
     * codes — powers "Recent Orders" widgets. Each item summarises the
     * order: how many of our SKUs are in it, its latest status, and dates.
     */
    public static function recentOrders(Collection $skuCodes, int $limit = 5): Collection
    {
        return self::matchSkus($skuCodes)
            ->filter(function ($row) { return $row->orderid; })
            ->groupBy('orderid')
            ->map(function ($group, $orderid) {
                $latest = $group->sortByDesc('create_date')->first();

                return (object) [
                    'orderid' => $orderid,
                    'sku_count' => $group->count(),
                    'status' => $latest->sendformaking,
                    'order_date' => $latest->create_date,
                    'dispatch_date' => $latest->dispatch_date,
                ];
            })
            ->sortByDesc('order_date')
            ->take($limit)
            ->values();
    }

    /**
     * Distinct VMS order IDs for a company's own generated SKUs — powers the
     * Shipment form's searchable "VMS Order" dropdown. Newest first, and
     * optionally filtered by a search term typed into the dropdown.
     */
    public static function ordersForCompany(int $companyId, string $q = ''): Collection
    {
        $skuCodes = Sku::whereHas('sample', function ($s) use ($companyId) {
            $s->where('company_id', $companyId);
        })->pluck('sku_code');

        if ($skuCodes->isEmpty()) {
            return collect();
        }

        try {
            $query = VmsSelldata::whereIn('sku', $skuCodes)->whereNotNull('orderid');
            if ($q !== '') {
                $query->where('orderid', 'like', "%{$q}%");
            }

            return $query->orderByDesc('create_date')->pluck('orderid')->unique()->values();
        } catch (\Throwable $e) {
            Log::warning('VMS order search failed: '.$e->getMessage());

            return collect();
        }
    }

    /**
     * The rows (one per SKU/size) of a specific VMS order, restricted to
     * SKUs this company has actually generated — powers the Shipment form's
     * "which SKUs are in this shipment" checkbox list, and shipment displays.
     */
    public static function skusForCompanyOrder(int $companyId, string $orderid): Collection
    {
        $skusByCode = Sku::whereHas('sample', function ($s) use ($companyId) {
            $s->where('company_id', $companyId);
        })->get()->keyBy('sku_code');

        if ($skusByCode->isEmpty() || $orderid === '') {
            return collect();
        }

        try {
            $rows = VmsSelldata::where('orderid', $orderid)
                ->whereIn('sku', $skusByCode->keys())
                ->get();
        } catch (\Throwable $e) {
            Log::warning('VMS order SKU lookup failed: '.$e->getMessage());

            return collect();
        }

        return $rows->map(function ($row) use ($skusByCode) {
            $sku = $skusByCode->get($row->sku);

            return (object) [
                'sku_id' => optional($sku)->id,
                'sku_code' => $row->sku,
                'size' => $row->size,
                'qty' => $row->qty,
                'status' => $row->sendformaking,
            ];
        })->filter(function ($row) { return $row->sku_id; })->values();
    }

    /**
     * Human-readable label for VMS's vms_selldata.sendformaking status code —
     * taken verbatim from VMS's own production.php status switch, which
     * covers every value in the sendformaking enum.
     */
    public static function statusLabel(?string $code): string
    {
        $labels = [
            'P' => 'Pending',
            'EB' => 'Sent for embroidery',
            'PR' => 'Sent for printing',
            'S' => 'Sent for making',
            'C' => 'Sent for Cutting',
            'AL' => 'Allotted',
            'Fi' => 'Sent for Finishing',
            'A' => 'Alteration',
            'D' => 'Dispatched',
            'R' => 'Re-Dispatched',
            'F' => 'Fabric Issue',
            'DY' => 'Sent for Dyeing',
            'KN' => 'Sent for Knitting',
            'RP' => 'Sent for Re-Printing',
            'H' => 'Sent for On-Hold',
        ];

        return $labels[$code] ?? 'Undefined Status';
    }
}
