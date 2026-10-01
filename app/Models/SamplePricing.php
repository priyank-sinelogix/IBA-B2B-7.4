<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SamplePricing extends Model
{
    protected $fillable = [
        'sample_id', 'style', 'fabric',
        'fabric_cost', 'accessories_cost', 'operational_cost', 'stitching_cost',
        'cogp', 'margin', 'price_usd',
    ];

    protected $casts = [
        'fabric_cost' => 'decimal:2',
        'accessories_cost' => 'decimal:2',
        'operational_cost' => 'decimal:2',
        'stitching_cost' => 'decimal:2',
        'cogp' => 'decimal:2',
        'margin' => 'decimal:2',
        'price_usd' => 'decimal:2',
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    // COGP = Fabric Cost + Accessories + Operational Cost + Stitching Cost
    public static function calculateCogp(array $data): float
    {
        return (float) ($data['fabric_cost'] ?? 0)
            + (float) ($data['accessories_cost'] ?? 0)
            + (float) ($data['operational_cost'] ?? 0)
            + (float) ($data['stitching_cost'] ?? 0);
    }

    /**
     * The unit sale price to use for a given sample — the most recently
     * added pricing entry for it, or 0 if the style was never priced.
     */
    public static function unitPriceForSample(?int $sampleId): float
    {
        if (!$sampleId) {
            return 0.0;
        }

        return (float) (self::where('sample_id', $sampleId)->latest()->value('price_usd') ?? 0);
    }

    /**
     * The unit sale price for one specific SKU — matched on its own sample_id
     * + style (style holds the SKU/display code, see admin.pricing.form).
     * Falls back to unitPriceForSample() when no SKU-specific entry exists,
     * so samples priced the old way (one entry, no per-size breakdown) still
     * resolve a price instead of silently charging 0.
     */
    public static function unitPriceForSku(?int $sampleId, ?string $skuCode): float
    {
        if (!$sampleId) {
            return 0.0;
        }

        if ($skuCode) {
            $price = self::where('sample_id', $sampleId)->where('style', $skuCode)->latest()->value('price_usd');
            if ($price !== null) {
                return (float) $price;
            }
        }

        return self::unitPriceForSample($sampleId);
    }
}
