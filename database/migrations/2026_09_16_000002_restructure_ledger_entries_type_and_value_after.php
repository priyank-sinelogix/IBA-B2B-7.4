<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Ledger entry types used to be accounting jargon (invoice/payment/credit_note/
     * debit_note) that only ever touched current_balance. Finance entries can now
     * also adjust credit_limit, so "type" is restructured to plainly say what field
     * moved and in which direction: used_balance_increase / used_balance_decrease /
     * credit_limit_increase / credit_limit_decrease. "balance_after" is renamed to
     * "value_after" since it now snapshots whichever field the entry changed.
     */
    public function up(): void
    {
        // 1) Widen the enum so both old and new values are valid while we migrate data.
        DB::statement("ALTER TABLE ledger_entries MODIFY type ENUM(
            'invoice','payment','credit_note','debit_note',
            'used_balance_increase','used_balance_decrease',
            'credit_limit_increase','credit_limit_decrease'
        ) NOT NULL DEFAULT 'used_balance_increase'");

        // 2) Remap existing rows onto the new vocabulary (same +/- meaning as before).
        DB::statement("UPDATE ledger_entries SET type = 'used_balance_increase' WHERE type IN ('invoice','debit_note')");
        DB::statement("UPDATE ledger_entries SET type = 'used_balance_decrease' WHERE type IN ('payment','credit_note')");

        // 3) Narrow the enum to just the final 4 values.
        DB::statement("ALTER TABLE ledger_entries MODIFY type ENUM(
            'used_balance_increase','used_balance_decrease',
            'credit_limit_increase','credit_limit_decrease'
        ) NOT NULL DEFAULT 'used_balance_increase'");

        // 4) Rename balance_after -> value_after.
        DB::statement('ALTER TABLE ledger_entries CHANGE balance_after value_after DECIMAL(14,2) NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE ledger_entries CHANGE value_after balance_after DECIMAL(14,2) NOT NULL');

        DB::statement("ALTER TABLE ledger_entries MODIFY type ENUM(
            'invoice','payment','credit_note','debit_note',
            'used_balance_increase','used_balance_decrease',
            'credit_limit_increase','credit_limit_decrease'
        ) NOT NULL DEFAULT 'invoice'");

        DB::statement("UPDATE ledger_entries SET type = 'invoice' WHERE type = 'used_balance_increase'");
        DB::statement("UPDATE ledger_entries SET type = 'payment' WHERE type = 'used_balance_decrease'");
        DB::statement("UPDATE ledger_entries SET type = 'debit_note' WHERE type = 'credit_limit_increase'");
        DB::statement("UPDATE ledger_entries SET type = 'credit_note' WHERE type = 'credit_limit_decrease'");

        DB::statement("ALTER TABLE ledger_entries MODIFY type ENUM('invoice','payment','credit_note','debit_note') NOT NULL DEFAULT 'invoice'");
    }
};
