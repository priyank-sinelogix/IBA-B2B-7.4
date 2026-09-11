<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Which SKUs (of the shipment's VMS order) actually went in this
        // particular shipment — a many-to-many link, since one order's SKUs
        // can be split across several shipments.
        Schema::create('shipment_skus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sku_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['shipment_id', 'sku_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipment_skus');
    }
};
