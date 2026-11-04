<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Cement', 'Steel Rebar', 'Sand', 'Gravel', 'Bricks', 'Tiles', 'Paint', 'Electrical Wire', 'PVC Pipes', 'Wood Planks']),
            'description' => fake()->sentence(),
        ];
    }
}
