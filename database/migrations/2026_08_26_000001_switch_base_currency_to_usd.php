<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $this->rebase('USD');

        // Every client company now defaults to the new base currency (USD) —
        // this only changes the currency label shown, the stored amounts are untouched.
        $usdId = DB::table('currencies')->where('code', 'USD')->value('id');
        if ($usdId) {
            DB::table('companies')->update(['currency_id' => $usdId]);
        }
    }

    public function down()
    {
        $this->rebase('INR');
    }

    /**
     * Re-expresses every currency's exchange_rate relative to a new base
     * currency and flips the is_base flag onto it. exchange_rate always means
     * "how many units of the base currency equal 1 unit of this currency".
     */
    private function rebase(string $newBaseCode): void
    {
        $newBase = DB::table('currencies')->where('code', $newBaseCode)->first();
        if (! $newBase) {
            return;
        }

        // How many old-base-units the new base currency was worth — the pivot
        // used to re-derive every other currency's rate against the new base.
        $pivotRate = (float) $newBase->exchange_rate;
        if ($pivotRate <= 0) {
            return;
        }

        foreach (DB::table('currencies')->get() as $currency) {
            $newRate = $currency->code === $newBaseCode
                ? 1.0
                : ((float) $currency->exchange_rate) / $pivotRate;

            DB::table('currencies')->where('id', $currency->id)->update([
                'exchange_rate' => round($newRate, 6),
                'is_base' => $currency->code === $newBaseCode,
            ]);
        }
    }
};
