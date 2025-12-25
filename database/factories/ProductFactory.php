<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'naziv' => fake()->regexify('[A-Za-z0-9]{150}'),
            'opis' => fake()->text(),
            'tip_vode' => fake()->regexify('[A-Za-z0-9]{50}'),
            'ambalaza' => fake()->regexify('[A-Za-z0-9]{50}'),
            'cena' => fake()->randomFloat(2, 0, 99999999.99),
        ];
    }
}
