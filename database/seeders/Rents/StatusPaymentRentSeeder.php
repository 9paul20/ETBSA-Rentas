<?php

namespace Database\Seeders\Rents;

use App\Models\Rents\StatusPaymentRent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPaymentRentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // StatusPaymentRent::factory()
        //     ->count(25)
        //     ->create();

        $EstadoPagoRentaPendienteDePago = StatusPaymentRent::create([
            'estadoPagoRenta' => 'Pendiente de pago',
            'descripcion' => 'El inquilino aún no ha realizado el pago del alquiler correspondiente',
            'textColor' => 'text-yellow-600',
            'bgColorPrimary' => 'bg-yellow-50',
            'bgColorSecondary' => 'bg-yellow-600',
        ]);

        $EstadoPagoRentaPendienteDePago = StatusPaymentRent::create([
            'estadoPagoRenta' => 'Pagado',
            'descripcion' => 'El inquilino ha realizado el pago del alquiler correspondiente y se encuentra al día con sus pagos',
            'textColor' => 'text-green-600',
            'bgColorPrimary' => 'bg-green-50',
            'bgColorSecondary' => 'bg-green-600',
        ]);

        $EstadoPagoRentaEnMora = StatusPaymentRent::create([
            'estadoPagoRenta' => 'En Mora',
            'descripcion' => 'El inquilino no ha realizado el pago del alquiler correspondiente en el plazo acordado y ha superado el periodo de gracia establecido en el contrato',
            'textColor' => 'text-orange-600',
            'bgColorPrimary' => 'bg-orange-50',
            'bgColorSecondary' => 'bg-orange-600',
        ]);

        $EstadoPagoRentaDisputa = StatusPaymentRent::create([
            'estadoPagoRenta' => 'En Disputa',
            'descripcion' => 'El estado de renta se encuentra en disputa debido a un desacuerdo entre el arrendador y el inquilino en cuanto al pago del alquiler',
            'textColor' => 'text-orange-600',
            'bgColorPrimary' => 'bg-orange-50',
            'bgColorSecondary' => 'bg-orange-600',
        ]);

        $EstadoPagoRentaEnProcesoDesalojo = StatusPaymentRent::create([
            'estadoPagoRenta' => 'En Proceso de Desalojo',
            'descripcion' => 'El inquilino ha incumplido con sus obligaciones de pago y se ha iniciado el proceso de desalojo para recuperar la propiedad',
            'textColor' => 'text-red-600',
            'bgColorPrimary' => 'bg-red-50',
            'bgColorSecondary' => 'bg-red-600',
        ]);
    }
}