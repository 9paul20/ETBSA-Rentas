<?php

namespace Database\Factories\Rents;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CupRentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tazaRenta' => fake()->unique()->word(),
            'rentaUnMes' => fake()->randomFloat(2, 0, 1000),
            'rentaDosMeses' => fake()->randomFloat(2, 0, 1000),
            'rentaTresMeses' => fake()->randomFloat(2, 0, 1000),
            'ivaUnMes' => fake()->randomFloat(2, 0, 1000),
            'ivaDosMeses' => fake()->randomFloat(2, 0, 1000),
            'ivaTresMeses' => fake()->randomFloat(2, 0, 1000),
            'descripcion' => fake()->text(),
        ];
    }
}