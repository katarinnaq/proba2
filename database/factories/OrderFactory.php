<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'korisnik' => User::factory()->create()->korisnik,
            'status' => fake()->randomElement(["na"]),
            'ukupna_cena' => fake()->randomFloat(2, 0, 99999999.99),
        ];
    }
}
