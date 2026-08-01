<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostBreakdownToSamplePricingsTable extends Migration
{
    public function up()
    {
        Schema::table('sample_pricings', function (Blueprint $table) {
            $table->decimal('accessories_cost', 10, 2)->default(0)->after('fabric_cost');
            $table->decimal('operational_cost', 10, 2)->default(0)->after('accessories_cost');
        });
    }

    public function down()
    {
        Schema::table('sample_pricings', function (Blueprint $table) {
            $table->dropColumn(['accessories_cost', 'operational_cost']);
        });
    }
}
