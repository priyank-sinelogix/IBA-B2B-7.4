<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleVersionImage extends Model
{
    protected $fillable = ['sample_version_id', 'image_path', 'sort_order'];

    public function sampleVersion()
    {
        return $this->belongsTo(SampleVersion::class);
    }

    public function url(): string
    {
        return \Storage::disk('public')->url($this->image_path);
    }
}
