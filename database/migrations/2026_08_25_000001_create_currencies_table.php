<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique(); // e.g. INR, USD, EUR
            $table->string('symbol', 10);
            $table->string('name');
            // Exchange rate: how many units of the BASE currency equal 1 unit of this currency.
            $table->decimal('exchange_rate', 14, 6)->default(1);
            $table->boolean('is_base')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // INR is the base currency this app has always priced in — seed it plus a
        // couple of common foreign currencies so admins have something to start from.
        DB::table('currencies')->insert([
            ['code' => 'INR', 'symbol' => '₹', 'name' => 'Indian Rupee', 'exchange_rate' => 1, 'is_base' => true, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'USD', 'symbol' => '$', 'name' => 'US Dollar', 'exchange_rate' => 88, 'is_base' => false, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'EUR', 'symbol' => '€', 'name' => 'Euro', 'exchange_rate' => 95, 'is_base' => false, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'GBP', 'symbol' => '£', 'name' => 'British Pound', 'exchange_rate' => 111, 'is_base' => false, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
