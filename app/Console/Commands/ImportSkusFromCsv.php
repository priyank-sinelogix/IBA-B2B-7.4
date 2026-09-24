<?php

namespace App\Console\Commands;

use App\Models\Sample;
use App\Models\SamplePricing;
use App\Models\Sku;
use Illuminate\Console\Command;

class ImportSkusFromCsv extends Command
{
    /**
     * Native module format — one row per SKU, mapping 1:1 onto the same fields
     * the SKU and Pricing admin forms already use:
     *
     * Sample Code, SKU Code, Size, Fabric, Print, Colour,
     * Fabric Cost, Accessories Cost, Operational Cost, Stitching Cost, Margin
     *
     * price_usd is never read from the CSV — it's always server-computed as
     * (Fabric Cost + Accessories Cost + Operational Cost + Stitching Cost) + Margin,
     * exactly like PricingController does, so it can never drift from that formula.
     */
    protected $signature = 'skus:import {csv : Path to the CSV file} {--dry-run : Preview without writing to the database}';

    protected $description = 'Bulk-create SKUs (and optional pricing entries) from a CSV list. A row is only generated when its Sample Code matches an existing sample; rows without a matching sample are skipped.';

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

    public function handle()
    {
        $path = $this->argument('csv');
        $dryRun = (bool) $this->option('dry-run');

        if (! file_exists($path)) {
            $this->error("File not found: {$path}");

            return 1;
        }

        $lines = array_filter(file($path), fn ($l) => trim($l) !== '');
        $rows = array_map('str_getcsv', $lines);
        $header = array_map('trim', array_shift($rows));

        $created = 0;
        $pricingCreated = 0;
        $skippedNoSampleCode = 0;
        $skippedNoMatch = 0;
        $skippedDuplicate = 0;
        $skippedNoSku = 0;

        foreach ($rows as $i => $row) {
            $rowNum = $i + 2; // +1 for header, +1 for 1-indexed

            if (count($row) < count($header)) {
                continue;
            }
            $data = array_combine($header, $row);

            $sampleCode = trim($data['Sample Code'] ?? '');
            if ($sampleCode === '') {
                $skippedNoSampleCode++;

                continue;
            }

            $sample = Sample::where('sample_code', $sampleCode)->first();
            if (! $sample) {
                $this->warn("Row {$rowNum}: no sample found for Sample Code '{$sampleCode}' — skipped.");
                $skippedNoMatch++;

                continue;
            }

            $skuCode = trim($data['SKU Code'] ?? '');
            if ($skuCode === '') {
                $this->warn("Row {$rowNum}: empty SKU Code — skipped.");
                $skippedNoSku++;

                continue;
            }

            if (Sku::where('sku_code', $skuCode)->exists()) {
                $this->warn("Row {$rowNum}: SKU '{$skuCode}' already exists — skipped.");
                $skippedDuplicate++;

                continue;
            }

            $sizeRaw = strtoupper(trim($data['Size'] ?? ''));
            $size = $this->sizeMap[$sizeRaw] ?? ($data['Size'] ?? null);

            $fabricCost = $this->numeric($data['Fabric Cost'] ?? null);
            $accessoriesCost = $this->numeric($data['Accessories Cost'] ?? null);
            $operationalCost = $this->numeric($data['Operational Cost'] ?? null);
            $stitchingCost = $this->numeric($data['Stitching Cost'] ?? null);
            $margin = $this->numeric($data['Margin'] ?? null);
            $hasPricing = $fabricCost !== null || $accessoriesCost !== null || $operationalCost !== null || $stitchingCost !== null || $margin !== null;
            $pricingExists = $hasPricing && SamplePricing::where('sample_id', $sample->id)->where('style', $skuCode)->exists();

            $cogp = ($fabricCost ?? 0) + ($accessoriesCost ?? 0) + ($operationalCost ?? 0) + ($stitchingCost ?? 0);
            $priceUsd = $cogp + ($margin ?? 0);

            if ($dryRun) {
                $this->info("Row {$rowNum}: WOULD create SKU '{$skuCode}' -> sample #{$sample->id} ({$sample->sample_code}), style='{$sample->style_name}', fabric='{$data['Fabric']}', print='{$data['Print']}', colour='{$data['Colour']}', size='{$size}'.");
                if ($hasPricing && ! $pricingExists) {
                    $this->info("Row {$rowNum}: WOULD create pricing entry -> cogp={$cogp}, margin=".($margin ?? 0).", price_usd={$priceUsd}.");
                } elseif ($hasPricing && $pricingExists) {
                    $this->warn("Row {$rowNum}: pricing entry for '{$skuCode}' already exists — would skip.");
                }
            } else {
                Sku::create([
                    'sample_id' => $sample->id,
                    'sku_code' => $skuCode,
                    'style_name' => $sample->style_name,
                    'fabric' => $data['Fabric'] ?? null,
                    'print' => $data['Print'] ?? null,
                    'colour' => $data['Colour'] ?? null,
                    'size' => $size,
                    'generated_by' => null,
                ]);
                $this->info("Row {$rowNum}: created SKU '{$skuCode}' -> sample #{$sample->id} ({$sample->sample_code}).");

                if ($hasPricing && ! $pricingExists) {
                    SamplePricing::create([
                        'sample_id' => $sample->id,
                        'style' => $skuCode,
                        'fabric' => $data['Fabric'] ?? null,
                        'fabric_cost' => $fabricCost ?? 0,
                        'accessories_cost' => $accessoriesCost ?? 0,
                        'operational_cost' => $operationalCost ?? 0,
                        'stitching_cost' => $stitchingCost ?? 0,
                        'cogp' => $cogp,
                        'margin' => $margin ?? 0,
                        'price_usd' => $priceUsd,
                    ]);
                    $pricingCreated++;
                    $this->info("Row {$rowNum}: created pricing entry -> price_usd={$priceUsd}.");
                } elseif ($hasPricing && $pricingExists) {
                    $this->warn("Row {$rowNum}: pricing entry for '{$skuCode}' already exists — skipped.");
                }
            }

            $created++;
        }

        $this->line('');
        $this->info(($dryRun ? '[DRY RUN] ' : '')."Done. SKUs created: {$created}, Pricing entries created: {$pricingCreated}, Skipped (no sample code): {$skippedNoSampleCode}, Skipped (no matching sample): {$skippedNoMatch}, Skipped (duplicate SKU): {$skippedDuplicate}, Skipped (empty SKU): {$skippedNoSku}.");

        return 0;
    }

    private function numeric($value): ?float
    {
        $value = trim((string) $value);

        return $value !== '' && is_numeric($value) ? (float) $value : null;
    }
}
