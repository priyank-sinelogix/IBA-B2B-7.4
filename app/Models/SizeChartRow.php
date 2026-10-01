<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeChartRow extends Model
{
    protected $fillable = [
        'sample_id', 'sample_request_id', 'specification', 'xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl', 'xxxxxl', 'sort_order',
    ];

    public $sizeColumns = ['xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl', 'xxxxxl'];

    /**
     * Size chart values come out of the decimal(6,2) column always padded to
     * 2 places (16.00, 8.70) — trims that to how a human would actually write
     * it (16, 8.7) without touching the stored value or a real .75 reading.
     */
    public static function fmt($value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return rtrim(rtrim(number_format((float) $value, 2, '.', ''), '0'), '.');
    }

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function sampleRequest()
    {
        return $this->belongsTo(SampleRequest::class);
    }
}
