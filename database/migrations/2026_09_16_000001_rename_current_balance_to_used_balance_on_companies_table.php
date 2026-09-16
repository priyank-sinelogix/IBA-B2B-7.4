<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * "current_balance" was confusing next to "credit_limit" — renamed to
     * "used_balance" to make clear it's the amount of credit already used,
     * not a positive account balance.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE companies CHANGE current_balance used_balance DECIMAL(14,2) NOT NULL DEFAULT 0');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE companies CHANGE used_balance current_balance DECIMAL(14,2) NOT NULL DEFAULT 0');
    }
};
