<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeChartRowsTable extends Migration
{
    public function up()
    {
        Schema::create('size_chart_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained()->cascadeOnDelete();
            $table->string('specification'); // e.g. "Chest Width", "Front Length"
            $table->decimal('xs', 6, 2)->nullable();
            $table->decimal('s', 6, 2)->nullable();
            $table->decimal('m', 6, 2)->nullable();
            $table->decimal('l', 6, 2)->nullable();
            $table->decimal('xl', 6, 2)->nullable();
            $table->decimal('xxl', 6, 2)->nullable();
            $table->decimal('xxxl', 6, 2)->nullable();
            $table->decimal('xxxxl', 6, 2)->nullable();
            $table->decimal('xxxxxl', 6, 2)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::table('samples', function (Blueprint $table) {
            $table->enum('size_chart_status', ['pending', 'approved'])->default('pending')->after('status');
            $table->foreignId('size_chart_approved_by')->nullable()->after('size_chart_status')->constrained('users')->nullOnDelete();
            $table->timestamp('size_chart_approved_at')->nullable()->after('size_chart_approved_by');
        });
    }

    public function down()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->dropForeign(['size_chart_approved_by']);
            $table->dropColumn(['size_chart_status', 'size_chart_approved_by', 'size_chart_approved_at']);
        });

        Schema::dropIfExists('size_chart_rows');
    }
}
