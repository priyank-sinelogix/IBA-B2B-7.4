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

    // "Unread" here means: the LAST word on this sample belongs to the other
    // side — not merely "posted since I last opened the page". The flag
    // stays up regardless of how many times it's viewed, and only clears
    // once this side posts their own reply (which makes their comment the
    // latest one again).
    public function unreadAdminComments()
    {
        return $this->hasMany(SampleComment::class)
            ->whereHas('user', function ($uq) {
                $uq->whereIn('role', ['admin', 'super_admin']);
            })
            ->where('sample_comments.id', function ($q) {
                $q->selectRaw('MAX(id)')
                    ->from('sample_comments as sc2')
                    ->whereColumn('sc2.sample_id', 'sample_comments.sample_id');
            });
    }

    public function unreadClientComments()
    {
        return $this->hasMany(SampleComment::class)
            ->whereHas('user', function ($uq) {
                $uq->where('role', 'customer');
            })
            ->where('sample_comments.id', function ($q) {
                $q->selectRaw('MAX(id)')
                    ->from('sample_comments as sc2')
                    ->whereColumn('sc2.sample_id', 'sample_comments.sample_id');
            });
    }

    public function scopeHasUnreadAdminComment($query)
    {
        return $query->whereHas('unreadAdminComments');
    }

    public function scopeHasUnreadClientComment($query)
    {
        return $query->whereHas('unreadClientComments');
    }
}
