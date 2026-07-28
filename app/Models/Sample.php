<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $fillable = [
        'company_id', 'sample_code', 'style_name', 'fabric', 'color',
        'status', 'submitted_by', 'submitted_at',
        'size_chart_status', 'size_chart_approved_by', 'size_chart_approved_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'size_chart_approved_at' => 'datetime',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function versions()
    {
        return $this->hasMany(SampleVersion::class)->orderBy('version_no');
    }

    public function latestVersion()
    {
        return $this->hasOne(SampleVersion::class)->latestOfMany('version_no');
    }

    public function comments()
    {
        return $this->hasMany(SampleComment::class)->latest();
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }

    public function sizeChartRows()
    {
        return $this->hasMany(SizeChartRow::class)->orderBy('sort_order');
    }

    public function sizeChartApprovedBy()
    {
        return $this->belongsTo(User::class, 'size_chart_approved_by');
    }

    public function pricings()
    {
        return $this->hasMany(SamplePricing::class);
    }
}
