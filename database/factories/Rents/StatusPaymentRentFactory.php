<?php

namespace Database\Factories\Rents;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StatusPaymentRentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'estadoPagoRenta' => fake()->unique()->word(),
            'descripcion' => fake()->text(),
        ];
    }
}