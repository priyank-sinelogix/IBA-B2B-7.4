<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SampleVersion extends Model
{
    protected $fillable = [
        'sample_id', 'version_no', 'image_path', 'fabric_swatch_path', 'notes', 'uploaded_by',
    ];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // All images uploaded for this version (multiple-image upload support).
    // image_path on this model is kept as the "cover" image for backward compatibility
    // with existing views that only show one thumbnail.
    public function images()
    {
        return $this->hasMany(SampleVersionImage::class)->orderBy('sort_order');
    }

    // Returns a viewable URL for the cover image. Uses local 'public' disk by default
    // (works immediately on XAMPP). Switch disk to 's3' in production for signed URLs.
    public function signedImageUrl(int $minutes = 15): string
    {
        $disk = config('filesystems.default', 'public');

        if ($disk === 's3') {
            return \Storage::disk('s3')->temporaryUrl($this->image_path, now()->addMinutes($minutes));
        }

        return \Storage::disk('public')->url($this->image_path);
    }
}
