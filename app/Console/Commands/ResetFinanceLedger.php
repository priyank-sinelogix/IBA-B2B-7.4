<?php

namespace App\Console\Commands;

use App\Models\AuditLog;
use App\Models\Company;
use App\Models\LedgerEntry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetFinanceLedger extends Command
{
    /**
     * Deletes every ledger entry and zeroes credit_limit + used_balance on every
     * company. ledger_entries are normally immutable (see LedgerController::destroy)
     * so this bypasses that by design, on explicit request — it does not touch
     * anything else. Each company's before/after balances are still written to
     * audit_logs so there is at least a record that the reset happened.
     */
    protected $signature = 'finance:reset-all {--confirm : Required to actually run the reset} {--dry-run : Preview counts without changing anything}';

    protected $description = 'Delete all ledger entries and zero every company\'s credit_limit and used_balance';

    public function handle()
    {
        $dryRun = (bool) $this->option('dry-run');
        $confirm = (bool) $this->option('confirm');

        if (! $dryRun && ! $confirm) {
            $this->error('This permanently deletes ALL ledger entries and zeroes EVERY company\'s balance.');
            $this->line('Run with --dry-run to preview, or --confirm to actually execute.');

            return 1;
        }

        $ledgerCount = LedgerEntry::count();
        $companies = Company::where(function ($q) {
            $q->where('credit_limit', '!=', 0)->orWhere('used_balance', '!=', 0);
        })->get(['id', 'name', 'credit_limit', 'used_balance']);

        if ($dryRun) {
            $this->info("[DRY RUN] Would delete {$ledgerCount} ledger entries.");
            $this->info("[DRY RUN] Would zero credit_limit/used_balance on {$companies->count()} companies:");
            foreach ($companies as $c) {
                $this->line("  #{$c->id} {$c->name}: credit_limit {$c->credit_limit} -> 0, used_balance {$c->used_balance} -> 0");
            }

            return 0;
        }

        DB::transaction(function () use ($companies, $ledgerCount) {
            foreach ($companies as $company) {
                AuditLog::create([
                    'company_id' => $company->id,
                    'user_id' => null,
                    'action' => 'finance.reset_all',
                    'subject_type' => 'Company',
                    'subject_id' => $company->id,
                    'changes' => [
                        'before' => ['credit_limit' => $company->credit_limit, 'used_balance' => $company->used_balance],
                        'after' => ['credit_limit' => 0, 'used_balance' => 0],
                    ],
                    'ip_address' => null,
                    'created_at' => now(),
                ]);

                $company->update(['credit_limit' => 0, 'used_balance' => 0]);
            }

            LedgerEntry::query()->delete();

            $this->info("Deleted {$ledgerCount} ledger entries.");
            $this->info("Zeroed credit_limit and used_balance on {$companies->count()} companies.");
        });

        return 0;
    }
}
