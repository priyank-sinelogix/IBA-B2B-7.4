<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeSizeChartRowsPolymorphic extends Migration
{
    public function up()
    {
        // Safe to re-run: only adds the column if a previous partial run didn't already add it
        // (MySQL doesn't roll back DDL, so a failed migration can leave this half-applied).
        if (! Schema::hasColumn('size_chart_rows', 'sample_request_id')) {
            Schema::table('size_chart_rows', function (Blueprint $table) {
                $table->foreignId('sample_request_id')->nullable()->after('sample_id')
                    ->constrained('sample_requests')->cascadeOnDelete();
            });
        }

        // sample_id must become nullable so a row can belong to a request instead.
        // Using raw SQL here (instead of Schema::change()) so this doesn't require
        // the doctrine/dbal package to be installed.
        DB::statement('ALTER TABLE size_chart_rows MODIFY sample_id BIGINT UNSIGNED NULL');
    }

    public function down()
    {
        if (Schema::hasColumn('size_chart_rows', 'sample_request_id')) {
            Schema::table('size_chart_rows', function (Blueprint $table) {
                $table->dropForeign(['sample_request_id']);
                $table->dropColumn('sample_request_id');
            });
        }

        DB::statement('ALTER TABLE size_chart_rows MODIFY sample_id BIGINT UNSIGNED NOT NULL');
    }
}
