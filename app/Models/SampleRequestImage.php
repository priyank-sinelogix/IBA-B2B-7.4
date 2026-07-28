<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleRequestImage extends Model
{
    protected $fillable = ['sample_request_id', 'image_path', 'sort_order'];

    public function sampleRequest()
    {
        return $this->belongsTo(SampleRequest::class);
    }

    public function url(): string
    {
        return \Storage::disk('public')->url($this->image_path);
    }
}
