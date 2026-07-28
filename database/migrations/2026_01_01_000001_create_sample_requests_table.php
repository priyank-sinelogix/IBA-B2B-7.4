<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('sample_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requested_by')->constrained('users')->cascadeOnDelete();
            $table->string('style_name');
            $table->string('fabric_preference')->nullable();
            $table->string('colour_preference')->nullable();
            $table->string('print_preference')->nullable();
            $table->text('description')->nullable();
            $table->string('reference_image_path')->nullable();
            $table->enum('status', ['pending', 'in_review', 'converted', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            // Once IBA accepts the request, it becomes a real Sample record for the approval workflow
            $table->foreignId('converted_sample_id')->nullable()->constrained('samples')->nullOnDelete();
            $table->timestamps();

            $table->index(['company_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sample_requests');
    }
}
