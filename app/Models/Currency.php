<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'code', 'symbol', 'name', 'exchange_rate', 'is_base', 'is_active',
    ];

    protected $casts = [
        'exchange_rate' => 'decimal:6',
        'is_base' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public static function base(): ?self
    {
        return static::where('is_base', true)->first();
    }
}
