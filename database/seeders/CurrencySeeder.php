<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'Dirham', 'short_name' => 'AED', 'symbol' => 'د.إ'],
            ['name' => 'US Dollar', 'short_name' => 'USD', 'symbol' => '$'],
            ['name' => 'Saudi Riyal', 'short_name' => 'SAR', 'symbol' => 'ر.س'],
            ['name' => 'Euro', 'short_name' => 'EUR', 'symbol' => '€'],
            ['name' => 'British Pound', 'short_name' => 'GBP', 'symbol' => '£'],
        ];

        foreach ($currencies as $currency) {
            Currency::firstOrCreate(['short_name' => $currency['short_name']], $currency);
        }
    }
}
