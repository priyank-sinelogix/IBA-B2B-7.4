<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ledger_entries', function (Blueprint $table) {
            // nullOnDelete (not cascade) — ledger history stays intact even if the
            // shipment record it was auto-generated for is later deleted.
            $table->foreignId('shipment_id')->nullable()->after('order_id')->constrained()->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('ledger_entries', function (Blueprint $table) {
            $table->dropConstrainedForeignId('shipment_id');
        });
    }
};
