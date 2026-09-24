<?php

namespace App\Console\Commands;

use App\Models\Sample;
use Illuminate\Console\Command;

class ListMissingSampleCodes extends Command
{
    /**
     * Reads database/seeders/data/sku_catalog.csv and prints every distinct
     * Sample Code that has no matching row in the samples table — the same
     * set SkuCatalogSeeder silently skips.
     */
    protected $signature = 'skus:missing-samples';

    protected $description = 'List distinct Sample Codes from the SKU catalog CSV that have no matching sample yet';

    public function handle()
    {
        $path = database_path('seeders/data/sku_catalog.csv');

        if (! file_exists($path)) {
            $this->error("CSV not found: {$path}");

            return 1;
        }

        $lines = array_filter(file($path), fn ($l) => trim($l) !== '');
        $rows = array_map('str_getcsv', $lines);
        $header = array_map('trim', array_shift($rows));

        $codes = [];
        foreach ($rows as $row) {
            if (count($row) < count($header)) {
                continue;
            }
            $data = array_combine($header, $row);
            $code = trim($data['Sample Code'] ?? '');
            if ($code !== '') {
                $codes[$code] = true;
            }
        }

        $existing = Sample::pluck('sample_code')->map(fn ($c) => trim($c))->flip()->all();
        $missing = array_diff_key($codes, $existing);

        $this->info('Distinct Sample Codes in CSV: '.count($codes));
        $this->info('Already exist as samples: '.(count($codes) - count($missing)));
        $this->warn('Missing (no matching sample): '.count($missing));
        $this->line('');

        foreach (array_keys($missing) as $code) {
            $this->line($code);
        }

        return 0;
    }
}
