<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\Person;
use App\Models\Rents\PaymentRent;
use App\Models\Rents\StatusRent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rent>
 */
class RentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaInicio = fake()->dateTimeBetween('-5 year', 'now');
        $fechaFin = fake()->dateTimeBetween($fechaInicio, '+2 year');
        return [
            'clvEquipo' => Equipment::inRandomOrder()->first()->clvEquipo,
            'clvCliente' => Person::inRandomOrder()->first()->clvPersona,
            'descripcion' => fake()->sentence(),
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'clvPagoRenta' => PaymentRent::inRandomOrder()->first()->clvPagoRenta, // Ejemplo de valor aleatorio entre 1 y 10
            'clvEstadoRenta' => StatusRent::inRandomOrder()->first()->clvEstadoRenta,
        ];
    }
}