<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->foreignId('currency_id')->nullable()->after('code')->constrained()->nullOnDelete();
        });

        // Every existing company was priced in INR before this feature existed —
        // default them to the base currency so nothing breaks.
        $baseCurrencyId = DB::table('currencies')->where('is_base', true)->value('id');
        if ($baseCurrencyId) {
            DB::table('companies')->whereNull('currency_id')->update(['currency_id' => $baseCurrencyId]);
        }
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropConstrainedForeignId('currency_id');
        });
    }
};
