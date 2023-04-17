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
        $pagoRenta = fake()->randomFloat(2, 0, 100000);
        $ivaRenta = $pagoRenta * 0.16;

        return [
            'pagoRenta' => $pagoRenta,
            'ivaRenta' => $ivaRenta,
            'clvEstadoPagoRenta' => StatusPaymentRent::inRandomOrder()->first()->clvEstadoPagoRenta,
        ];
    }
}