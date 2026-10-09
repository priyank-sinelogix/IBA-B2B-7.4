<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandingAsset extends Model
{
    protected $fillable = [
        'company_id', 'category', 'name', 'applicable_to', 'status', 'submitted_by', 'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public const CATEGORIES = [
        'main_label' => 'Main Label',
        'wash_care_label' => 'Wash Care Label',
        'size_label' => 'Size Label',
        'hang_tag' => 'Hang Tag',
        'packaging_bag' => 'Packaging Bag',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function versions()
    {
        return $this->hasMany(BrandingAssetVersion::class)->orderBy('version_no');
    }

    public function latestVersion()
    {
        return $this->hasOne(BrandingAssetVersion::class)->latestOfMany('version_no');
    }

    public function comments()
    {
        return $this->hasMany(BrandingAssetComment::class)->latest();
    }

    public function submittedBy()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }
}
