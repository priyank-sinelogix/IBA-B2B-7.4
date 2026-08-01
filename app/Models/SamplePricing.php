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
}
