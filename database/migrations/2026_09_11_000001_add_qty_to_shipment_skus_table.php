<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shipment_skus', function (Blueprint $table) {
            // Snapshot of how many units of this SKU are in *this* shipment —
            // defaults to VMS's order qty but is editable, since one order's
            // qty for a SKU can be split across several shipments.
            $table->unsignedInteger('qty')->nullable()->after('sku_id');
        });
    }

    public function down(): void
    {
        Schema::table('shipment_skus', function (Blueprint $table) {
            $table->dropColumn('qty');
        });
    }
};
