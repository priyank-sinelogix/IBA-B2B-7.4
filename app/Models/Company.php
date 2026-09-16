<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'currency_id', 'credit_limit', 'used_balance', 'logo_path', 'is_active',
    ];

    protected $casts = [
        'credit_limit' => 'decimal:2',
        'used_balance' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

    public function ledgerEntries()
    {
        return $this->hasMany(LedgerEntry::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function creditUsedPercent(): float
    {
        if ((float) $this->credit_limit <= 0) {
            return 0;
        }

        return round(((float) $this->used_balance / (float) $this->credit_limit) * 100, 1);
    }

    /**
     * Credit still available. Negative means used_balance has gone past credit_limit.
     */
    public function remainingAmount(): float
    {
        return round((float) $this->credit_limit - (float) $this->used_balance, 2);
    }
}
