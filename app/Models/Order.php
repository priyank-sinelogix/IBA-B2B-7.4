<?php

namespace App\Models;

use App\Support\VmsOrderMatcher;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'company_id', 'sample_id', 'order_no', 'style_name', 'quantity', 'current_stage', 'eta',
    ];

    protected $casts = [
        'eta' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    /**
     * Look up any vms_selldata rows whose sku matches one of this order's
     * sample's generated SKUs. Returns an empty collection (never throws) if
     * no sample is linked, no SKUs exist yet, or the VMS server is unreachable —
     * the caller doesn't need to know why, just whether matches were found.
     */
    public function vmsMatches()
    {
        if (!$this->sample) {
            return collect();
        }

        $skuCodes = $this->sample->skus()->pluck('sku_code')->filter()->values();

        return VmsOrderMatcher::matchSkus($skuCodes);
    }

    public function stageLogs()
    {
        return $this->hasMany(OrderStageLog::class)->orderBy('changed_at');
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
