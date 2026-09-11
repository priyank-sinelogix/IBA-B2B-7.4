<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            // VMS's own order identifier (vms_selldata.orderid) — plain reference,
            // not a foreign key, since VMS lives on a separate database/connection.
            $table->string('vms_orderid')->nullable()->after('order_id');
        });
    }

    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn('vms_orderid');
        });
    }
};
