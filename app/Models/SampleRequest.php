<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleRequest extends Model
{
    protected $fillable = [
        'company_id', 'requested_by', 'style_name', 'fabric_preference',
        'colour_preference', 'print_preference', 'description', 'reference_image_path',
        'status', 'admin_notes', 'converted_sample_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function convertedSample()
    {
        return $this->belongsTo(Sample::class, 'converted_sample_id');
    }

    public function referenceImageUrl()
    {
        if (! $this->reference_image_path) {
            return null;
        }

        return \Storage::disk('public')->url($this->reference_image_path);
    }

    // All reference images uploaded with this request (multiple-image upload support).
    // reference_image_path is kept as the "cover" image for backward compatibility.
    public function images()
    {
        return $this->hasMany(SampleRequestImage::class)->orderBy('sort_order');
    }

    // Size chart the client fills in at request time (same grid used on the Sample later).
    public function sizeChartRows()
    {
        return $this->hasMany(SizeChartRow::class)->orderBy('sort_order');
    }
}
