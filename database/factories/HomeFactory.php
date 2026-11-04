<?php

namespace Database\Factories;

use App\Models\Home;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Home>
 */
class HomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->streetName().' Residence';

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'description' => fake()->paragraph(),
            'location' => fake()->city().', '.fake()->stateAbbr(),
            'price' => fake()->randomFloat(2, 150000, 950000),
            'bedrooms' => fake()->numberBetween(2, 6),
            'bathrooms' => fake()->numberBetween(1, 5),
            'area_sqft' => fake()->numberBetween(1200, 5000),
            'status' => fake()->randomElement(['planning', 'under_construction', 'completed']),
            'image_url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
            'is_featured' => fake()->boolean(40),
        ];
    }

    /**
     * Indicate that the home is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
        ]);
    }

    /**
     * Indicate that the home is featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
