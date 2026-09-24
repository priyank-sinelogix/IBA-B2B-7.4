<?php

namespace Database\Seeders;

use App\Models\Sample;
use App\Models\SamplePricing;
use App\Models\Sku;
use Illuminate\Database\Seeder;

class SkuPriceSeeder extends Seeder
{
    /**
     * One row per SKU, mirroring the SKU_Price_Upload_Template.csv columns.
     * Safe to re-run: rows are skipped when the sample doesn't exist, the SKU
     * already exists, or a pricing entry for that sample+SKU already exists.
     */
    private array $rows = [
        ['sample_code' => '1-M-WH-LS-XS-SL-POL', 'sku_code' => '1-M-WH-LS-S-SL-POL', 'size' => 'S', 'fabric' => 'Polyester', 'print' => null, 'colour' => 'White', 'fabric_cost' => 18.75, 'accessories_cost' => 0, 'operational_cost' => 0, 'stitching_cost' => 0, 'margin' => 0],
        ['sample_code' => '1-M-WH-LS-XS-SL-POL', 'sku_code' => '1-M-WH-LS-M-SL-POL', 'size' => 'M', 'fabric' => 'Polyester', 'print' => null, 'colour' => 'White', 'fabric_cost' => 18.75, 'accessories_cost' => 0, 'operational_cost' => 0, 'stitching_cost' => 0, 'margin' => 0],
        ['sample_code' => '1-M-WH-LS-XS-SL-POL', 'sku_code' => '1-M-WH-LS-L-SL-POL', 'size' => 'L', 'fabric' => 'Polyester', 'print' => null, 'colour' => 'White', 'fabric_cost' => 18.75, 'accessories_cost' => 0, 'operational_cost' => 0, 'stitching_cost' => 0, 'margin' => 0],
        ['sample_code' => '1-M-WH-LS-XS-SL-POL', 'sku_code' => '1-M-WH-LS-XL-SL-POL', 'size' => 'XL', 'fabric' => 'Polyester', 'print' => null, 'colour' => 'White', 'fabric_cost' => 18.75, 'accessories_cost' => 0, 'operational_cost' => 0, 'stitching_cost' => 0, 'margin' => 0],
        ['sample_code' => '1-M-WH-LS-XS-SL-POL', 'sku_code' => '1-M-WH-LS-2XL-SL-POL', 'size' => '2XL', 'fabric' => 'Polyester', 'print' => null, 'colour' => 'White', 'fabric_cost' => 18.75, 'accessories_cost' => 0, 'operational_cost' => 0, 'stitching_cost' => 0, 'margin' => 0],
        ['sample_code' => '1-M-WH-LS-XS-SL-POL', 'sku_code' => '1-M-WH-LS-3XL-SL-POL', 'size' => '3XL', 'fabric' => 'Polyester', 'print' => null, 'colour' => 'White', 'fabric_cost' => 18.75, 'accessories_cost' => 0, 'operational_cost' => 0, 'stitching_cost' => 0, 'margin' => 0],
    ];

    public function run()
    {
        foreach ($this->rows as $row) {
            $sample = Sample::where('sample_code', $row['sample_code'])->first();
            if (! $sample) {
                $this->command->warn("No sample found for '{$row['sample_code']}' — skipped '{$row['sku_code']}'.");

                continue;
            }

            if (! Sku::where('sku_code', $row['sku_code'])->exists()) {
                Sku::create([
                    'sample_id' => $sample->id,
                    'sku_code' => $row['sku_code'],
                    'style_name' => $sample->style_name,
                    'fabric' => $row['fabric'],
                    'print' => $row['print'],
                    'colour' => $row['colour'],
                    'size' => $row['size'],
                    'generated_by' => null,
                ]);
                $this->command->info("Created SKU '{$row['sku_code']}'.");
            } else {
                $this->command->warn("SKU '{$row['sku_code']}' already exists — skipped.");
            }

            $pricingExists = SamplePricing::where('sample_id', $sample->id)->where('style', $row['sku_code'])->exists();
            if (! $pricingExists) {
                $cogp = $row['fabric_cost'] + $row['accessories_cost'] + $row['operational_cost'] + $row['stitching_cost'];
                SamplePricing::create([
                    'sample_id' => $sample->id,
                    'style' => $row['sku_code'],
                    'fabric' => $row['fabric'],
                    'fabric_cost' => $row['fabric_cost'],
                    'accessories_cost' => $row['accessories_cost'],
                    'operational_cost' => $row['operational_cost'],
                    'stitching_cost' => $row['stitching_cost'],
                    'cogp' => $cogp,
                    'margin' => $row['margin'],
                    'price_usd' => $cogp + $row['margin'],
                ]);
                $this->command->info("Created pricing entry for '{$row['sku_code']}' -> \${$cogp}.");
            } else {
                $this->command->warn("Pricing entry for '{$row['sku_code']}' already exists — skipped.");
            }
        }
    }
}
