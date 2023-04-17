<?php

namespace Database\Factories\Equipments;

use App\Models\Equipments\TypeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipments\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria' => fake()->unique()->word(),
            'descripcion' => fake()->sentence(),
            'clvTipoCategoria' => TypeCategory::inRandomOrder()->first()->clvTipoCategoria,
        ];
    }
}