<?php

namespace Database\Factories;

use App\Models\Persons\ComTel;
use App\Models\Persons\Nacionalidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombrePersona' => fake()->firstName(),
            'apePaternoPersona' => fake()->lastName(),
            'apeMaternoPersona' => fake()->lastName(),
            'nacimiento' => fake()->date('Y-m-d', '-18 years'),
            'clvNacionalidad' => Nacionalidad::inRandomOrder()->first()->clvNacionalidad,
            'telefono' => fake()->phoneNumber(),
            'celular' => fake()->phoneNumber(),
            'clvComTel' => ComTel::inRandomOrder()->first()->clvComTel,
            'ocupacion' => fake()->jobTitle(),
            'informacion' => fake()->text(200)
        ];
    }
}