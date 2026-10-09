<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandingAssetVersionImage extends Model
{
    protected $fillable = ['branding_asset_version_id', 'image_path', 'sort_order'];

    public function brandingAssetVersion()
    {
        return $this->belongsTo(BrandingAssetVersion::class);
    }

    public function url(): string
    {
        return \Storage::disk('public')->url($this->image_path);
    }
}
