<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'project_id' => 1,
            'category_id' => 1,
            'payment_id' => 1,
            'currency_id' => 1,
            'description' => fake()->sentence(),
            'vendor_id' => 1,
            'amount' => fake()->randomFloat(2, 100, 10000),
            'vat' => 5.00,
            'vat_amount' => 0.00,
            'cash_deposit' => 0.00,
            'received_from_bank' => 0.00,
            'received_from_owner' => 0.00,
            'status' => fake()->randomElement(['paid', 'pending']),
        ];
    }
}
