<?php

namespace App\Support;

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
