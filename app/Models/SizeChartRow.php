<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeChartRow extends Model
{
    protected $fillable = [
        'sample_id', 'sample_request_id', 'specification', 'xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl', 'xxxxxl', 'sort_order',
    ];

    public $sizeColumns = ['xs', 's', 'm', 'l', 'xl', 'xxl', 'xxxl', 'xxxxl', 'xxxxxl'];

    public function sample()
    {
        return $this->belongsTo(Sample::class);
    }

    public function sampleRequest()
    {
        return $this->belongsTo(SampleRequest::class);
    }
}
