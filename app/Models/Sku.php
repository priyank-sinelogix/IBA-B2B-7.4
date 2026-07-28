<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $fillable = [
        'sample_id', 'sku_code', 'style_name', 'fabric', 'print', 'colour', 'size', 'generated_by',
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    /**
     * Simple, readable auto-suggestion: STYLE-FABRIC-COLOUR-SIZE (uppercased, dashed).
     * Admin can edit before saving.
     */
    public static function suggestCode(string $style, ?string $fabric, ?string $colour, ?string $size): string
    {
        $parts = array_filter([$style, $fabric, $colour, $size]);
        $slug = implode('-', array_map(function ($p) {
            return strtoupper(preg_replace('/[^A-Za-z0-9]+/', '', substr($p, 0, 6)));
        }, $parts));

        return $slug;
    }
}
