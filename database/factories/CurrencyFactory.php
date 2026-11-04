<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Dirham', 'US Dollar', 'Saudi Riyal', 'Euro', 'British Pound']),
            'short_name' => fake()->randomElement(['AED', 'USD', 'SAR', 'EUR', 'GBP']),
            'symbol' => fake()->randomElement(['د.إ', '$', 'ر.س', '€', '£']),
        ];
    }
}
