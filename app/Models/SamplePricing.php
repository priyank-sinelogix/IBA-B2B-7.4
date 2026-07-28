<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SamplePricing extends Model
{
    protected $fillable = [
        'sample_id', 'style', 'fabric', 'fabric_cost', 'stitching_cost', 'cogp', 'margin', 'price_usd',
    ];

    protected $casts = [
        'fabric_cost' => 'decimal:2',
        'stitching_cost' => 'decimal:2',
        'cogp' => 'decimal:2',
        'margin' => 'decimal:2',
        'price_usd' => 'decimal:2',
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }
}
