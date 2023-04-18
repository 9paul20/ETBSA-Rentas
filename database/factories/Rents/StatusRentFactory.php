<?php

namespace Database\Factories\Rents;

use App\Models\Rents\CupRent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StatusRentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estadoRenta' => fake()->unique()->word(),
            'descripcion' => fake()->text(),
        ];
    }
}