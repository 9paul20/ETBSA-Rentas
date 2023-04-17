<?php

namespace Database\Factories\Persons;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persons\Nacionalidad>
 */
class NacionalidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nacionalidad' => fake()->unique()->country(),
            'descripcion' => fake()->paragraph(),
        ];
    }
}