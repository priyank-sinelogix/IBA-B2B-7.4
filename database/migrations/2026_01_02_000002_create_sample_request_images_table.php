<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleRequestImagesTable extends Migration
{
    public function up()
    {
        Schema::create('sample_request_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_request_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sample_request_images');
    }
}
