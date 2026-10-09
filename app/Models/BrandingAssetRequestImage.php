<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandingAssetRequestImage extends Model
{
    protected $fillable = ['branding_asset_request_id', 'image_path', 'sort_order'];

    public function brandingAssetRequest()
    {
        return $this->belongsTo(BrandingAssetRequest::class);
    }

    public function url(): string
    {
        return \Storage::disk('public')->url($this->image_path);
    }
}
