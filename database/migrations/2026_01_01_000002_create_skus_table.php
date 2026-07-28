<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkusTable extends Migration
{
    public function up()
    {
        Schema::create('skus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained()->cascadeOnDelete();
            $table->string('sku_code')->unique(); // e.g. LBD-LUCREZIA-MCS-BLK-1802
            $table->string('style_name');
            $table->string('fabric')->nullable();
            $table->string('print')->nullable();
            $table->string('colour')->nullable();
            $table->string('size')->nullable(); // XS, S, M, L, XL, 2XL, 3XL, 4XL, 5XL or blank if one SKU per style/colourway
            $table->foreignId('generated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('skus');
    }
}
