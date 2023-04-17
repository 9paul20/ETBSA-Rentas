<?php

namespace Database\Factories\Persons;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persons\ComTel>
 */
class ComTelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'companiaTelefonica' => fake()->unique()->company(),
            'descripcion' => fake()->paragraph(),
        ];
    }
}