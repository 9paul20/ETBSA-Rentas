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
        $rentaUnMes = fake()->randomFloat(2, 0, 100000);
        $rentaDosMeses = fake()->randomFloat(2, 0, 100000);
        $rentaTresMeses = fake()->randomFloat(2, 0, 100000);
        $ivaUnMes = $rentaUnMes * 0.16;
        $ivaDosMeses = $rentaDosMeses * 0.16;
        $ivaTresMeses = $rentaTresMeses * 0.16;

        return [
            'tazaRenta' => fake()->unique()->word(),
            'rentaUnMes' => $rentaUnMes,
            'rentaDosMeses' => $rentaDosMeses,
            'rentaTresMeses' => $rentaTresMeses,
            'ivaUnMes' => $ivaUnMes,
            'ivaDosMeses' => $ivaDosMeses,
            'ivaTresMeses' => $ivaTresMeses,
            'descripcion' => fake()->text(),
        ];
    }
}