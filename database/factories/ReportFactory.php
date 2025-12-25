<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'admin' => User::factory()->create()->admin,
            'naziv' => fake()->regexify('[A-Za-z0-9]{150}'),
            'period_od' => fake()->date(),
            'period_do' => fake()->date(),
            'datum_kreiranja' => fake()->date(),
        ];
    }
}
