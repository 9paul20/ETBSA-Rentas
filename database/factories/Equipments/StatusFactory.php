<?php

namespace Database\Factories\Equipments;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipments\Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'disponibilidad' => fake()->unique()->word(),
            'descripcion' => fake()->sentence(),
        ];
    }
}