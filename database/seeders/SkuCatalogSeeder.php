<?php

namespace Database\Seeders;

use App\Models\Sample;
use App\Models\SamplePricing;
use App\Models\Sku;
use Illuminate\Database\Seeder;

class SkuCatalogSeeder extends Seeder
{
    /**
     * Reads database/seeders/data/sku_catalog.csv (same 11-column format as
     * SKU_Price_Upload_Template.csv). A row is only created when its Sample
     * Code matches an existing sample; everything else is skipped. Safe to
     * re-run: existing SKUs / pricing entries are never duplicated or edited.
     */
    private array $sizeMap = [
        'XS' => 'XS', 'EXTRA SMALL' => 'XS',
        'S' => 'S', 'SMALL' => 'S',
        'M' => 'M', 'MEDIUM' => 'M',
        'L' => 'L', 'LARGE' => 'L',
        'XL' => 'XL', 'EXTRA LARGE' => 'XL',
        '2XL' => '2XL', '2X LARGE' => '2XL',
        '3XL' => '3XL', '3X LARGE' => '3XL',
        '4XL' => '4XL', '4X LARGE' => '4XL',
        '5XL' => '5XL', '5X LARGE' => '5XL',
    ];

    public function run()
    {
        $path = __DIR__.'/data/sku_catalog.csv';

        if (! file_exists($path)) {
            $this->command->error("CSV not found: {$path}");

            return;
        }

        $lines = array_filter(file($path), fn ($l) => trim($l) !== '');
        $rows = array_map('str_getcsv', $lines);
        $header = array_map('trim', array_shift($rows));

        $skuCreated = 0;
        $pricingCreated = 0;
        $skippedNoMatch = 0;
        $skippedDuplicateSku = 0;
        $skippedDuplicatePricing = 0;
        $missingSamples = [];

        foreach ($rows as $i => $row) {
            $rowNum = $i + 2;

            if (count($row) < count($header)) {
                continue;
            }
            $data = array_combine($header, $row);

            $sampleCode = trim($data['Sample Code'] ?? '');
            $skuCode = trim($data['SKU Code'] ?? '');
            if ($sampleCode === '' || $skuCode === '') {
                continue;
            }

            $sample = Sample::where('sample_code', $sampleCode)->first();
            if (! $sample) {
                $missingSamples[$sampleCode] = true;
                $skippedNoMatch++;

                continue;
            }

            $sizeRaw = strtoupper(trim($data['Size'] ?? ''));
            $size = $this->sizeMap[$sizeRaw] ?? ($data['Size'] ?? null);

            $fabricCost = $this->numeric($data['Fabric Cost'] ?? null) ?? 0;
            $accessoriesCost = $this->numeric($data['Accessories Cost'] ?? null) ?? 0;
            $operationalCost = $this->numeric($data['Operational Cost'] ?? null) ?? 0;
            $stitchingCost = $this->numeric($data['Stitching Cost'] ?? null) ?? 0;
            $margin = $this->numeric($data['Margin'] ?? null) ?? 0;
            $cogp = $fabricCost + $accessoriesCost + $operationalCost + $stitchingCost;
            $priceUsd = $cogp + $margin;

            if (! Sku::where('sku_code', $skuCode)->exists()) {
                Sku::create([
                    'sample_id' => $sample->id,
                    'sku_code' => $skuCode,
                    'style_name' => $sample->style_name,
                    'fabric' => $data['Fabric'] ?: null,
                    'print' => $data['Print'] ?: null,
                    'colour' => $data['Colour'] ?: null,
                    'size' => $size,
                    'generated_by' => null,
                ]);
                $skuCreated++;
            } else {
                $skippedDuplicateSku++;
            }

            $pricingExists = SamplePricing::where('sample_id', $sample->id)->where('style', $skuCode)->exists();
            if (! $pricingExists) {
                SamplePricing::create([
                    'sample_id' => $sample->id,
                    'style' => $skuCode,
                    'fabric' => $data['Fabric'] ?: null,
                    'fabric_cost' => $fabricCost,
                    'accessories_cost' => $accessoriesCost,
                    'operational_cost' => $operationalCost,
                    'stitching_cost' => $stitchingCost,
                    'cogp' => $cogp,
                    'margin' => $margin,
                    'price_usd' => $priceUsd,
                ]);
                $pricingCreated++;
            } else {
                $skippedDuplicatePricing++;
            }
        }

        $this->command->info("Done. SKUs created: {$skuCreated}, Pricing entries created: {$pricingCreated}.");
        $this->command->warn("Skipped rows (no matching sample): {$skippedNoMatch}.");
        $this->command->warn("Skipped (SKU already existed): {$skippedDuplicateSku}, Skipped (pricing already existed): {$skippedDuplicatePricing}.");

        if ($missingSamples) {
            $this->command->warn('Distinct Sample Codes with no match ('.count($missingSamples).'): '.implode(', ', array_slice(array_keys($missingSamples), 0, 20)).(count($missingSamples) > 20 ? ', ...' : ''));
        }
    }

    private function numeric($value): ?float
    {
        $value = trim((string) $value);

        return $value !== '' && is_numeric($value) ? (float) $value : null;
    }
}
