<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplePricingsTable extends Migration
{
    public function up()
    {
        Schema::create('sample_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained()->cascadeOnDelete();
            $table->string('style'); // usually the generated SKU code, e.g. LBD-LUCREZIA-MCS-BLK-1802
            $table->string('fabric')->nullable();
            $table->decimal('fabric_cost', 10, 2)->default(0); // fabric + accessories
            $table->decimal('stitching_cost', 10, 2)->default(0);
            $table->decimal('cogp', 10, 2)->default(0); // cost of goods produced
            $table->decimal('margin', 10, 2)->default(0);
            $table->decimal('price_usd', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sample_pricings');
    }
}
