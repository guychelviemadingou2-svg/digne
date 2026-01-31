<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'quantity' => fake()->numberBetween(0, 100),
            'minimum_quantity' => fake()->numberBetween(5, 20),
            'expiry_date' => fake()->optional()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
