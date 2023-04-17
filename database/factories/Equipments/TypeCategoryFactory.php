<?php

namespace Database\Factories\Equipments;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipments\TypeCategory>
 */
class TypeCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipoCategoria' => fake()->unique()->word(),
            'descripcion' => fake()->sentence(),
        ];
    }
}