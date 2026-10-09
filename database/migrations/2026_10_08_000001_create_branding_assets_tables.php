<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branding_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->enum('category', ['main_label', 'wash_care_label', 'size_label', 'hang_tag', 'packaging_bag']);
            $table->string('name');
            $table->string('applicable_to')->nullable(); // e.g. "6AM Worksuit", "All Styles"
            $table->enum('status', ['pending', 'approved', 'revision_requested'])->default('pending');
            $table->foreignId('submitted_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();

            $table->index(['company_id', 'status']);
            $table->index(['company_id', 'category']);
        });

        Schema::create('branding_asset_versions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branding_asset_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('version_no')->default(1);
            $table->string('image_path'); // cover image
            $table->text('notes')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['branding_asset_id', 'version_no']);
        });

        Schema::create('branding_asset_version_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branding_asset_version_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('branding_asset_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branding_asset_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branding_asset_version_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('comment');
            $table->enum('action', ['comment', 'approve', 'revise'])->default('comment');
            $table->timestamps();
        });

        Schema::create('branding_asset_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('requested_by')->constrained('users')->cascadeOnDelete();
            $table->enum('category', ['main_label', 'wash_care_label', 'size_label', 'hang_tag', 'packaging_bag']);
            $table->string('name');
            $table->string('applicable_to')->nullable();
            $table->text('description')->nullable();
            $table->string('reference_image_path')->nullable(); // legacy cover, mirrors sample_requests
            $table->enum('status', ['pending', 'in_review', 'converted', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->foreignId('converted_asset_id')->nullable()->constrained('branding_assets')->nullOnDelete();
            $table->timestamps();

            $table->index(['company_id', 'status']);
        });

        Schema::create('branding_asset_request_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branding_asset_request_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branding_asset_request_images');
        Schema::dropIfExists('branding_asset_requests');
        Schema::dropIfExists('branding_asset_comments');
        Schema::dropIfExists('branding_asset_version_images');
        Schema::dropIfExists('branding_asset_versions');
        Schema::dropIfExists('branding_assets');
    }
};
