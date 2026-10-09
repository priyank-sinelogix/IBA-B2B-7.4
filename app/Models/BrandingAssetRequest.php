<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandingAssetRequest extends Model
{
    protected $fillable = [
        'company_id', 'requested_by', 'category', 'name', 'applicable_to', 'description',
        'reference_image_path', 'status', 'admin_notes', 'converted_asset_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function convertedAsset()
    {
        return $this->belongsTo(BrandingAsset::class, 'converted_asset_id');
    }

    // All reference images uploaded with this request. reference_image_path stays
    // the "cover" image for backward compatibility.
    public function images()
    {
        return $this->hasMany(BrandingAssetRequestImage::class)->orderBy('sort_order');
    }

    public function categoryLabel(): string
    {
        return BrandingAsset::CATEGORIES[$this->category] ?? $this->category;
    }
}
