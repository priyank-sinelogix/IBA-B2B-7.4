<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandingAssetVersion extends Model
{
    protected $fillable = [
        'branding_asset_id', 'version_no', 'image_path', 'notes', 'uploaded_by',
    ];

    public function brandingAsset()
    {
        return $this->belongsTo(BrandingAsset::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // All images uploaded for this version. image_path stays the "cover" image
    // for backward-compatible single-thumbnail displays.
    public function images()
    {
        return $this->hasMany(BrandingAssetVersionImage::class)->orderBy('sort_order');
    }

    public function coverUrl(): string
    {
        return \Storage::disk('public')->url($this->image_path);
    }
}
