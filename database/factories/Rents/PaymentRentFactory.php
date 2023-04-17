<?php

namespace Database\Factories\Rents;

use App\Models\Rents\StatusPaymentRent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentRentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pagoRenta' => fake()->randomFloat(2, 0, 999999.99),
            'ivaRenta' => fake()->randomFloat(2, 0, 999999.99),
            'clvEstadoPagoRenta' => StatusPaymentRent::inRandomOrder()->first()->clvEstadoPagoRenta,
        ];
    }
}