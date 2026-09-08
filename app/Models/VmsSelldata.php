<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Read-only view of the vms.vms_selldata table on the separate VMS server.
 * This app never writes to VMS — it only looks up matching SKUs there.
 */
class VmsSelldata extends Model
{
    protected $connection = 'vms';

    protected $table = 'vms_selldata';

    public $timestamps = false;

    protected $guarded = ['*'];

    public function save(array $options = [])
    {
        throw new \RuntimeException('VmsSelldata is read-only.');
    }

    public function delete()
    {
        throw new \RuntimeException('VmsSelldata is read-only.');
    }
}
