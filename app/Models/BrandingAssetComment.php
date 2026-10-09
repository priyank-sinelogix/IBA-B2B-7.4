<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandingAssetComment extends Model
{
    protected $fillable = [
        'branding_asset_id', 'branding_asset_version_id', 'user_id', 'comment', 'action',
    ];

    public function brandingAsset()
    {
        return $this->belongsTo(BrandingAsset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
