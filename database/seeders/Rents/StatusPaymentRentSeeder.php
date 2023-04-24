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
        ]);

        $EstadoPagoRentaPendienteDePago = StatusPaymentRent::create([
            'estadoPagoRenta' => 'Pagado',
            'descripcion' => 'El inquilino ha realizado el pago del alquiler correspondiente y se encuentra al día con sus pagos',
        ]);

        $EstadoPagoRentaEnMora = StatusPaymentRent::create([
            'estadoPagoRenta' => 'En mora',
            'descripcion' => 'El inquilino no ha realizado el pago del alquiler correspondiente en el plazo acordado y ha superado el periodo de gracia establecido en el contrato',
        ]);

        $EstadoPagoRentaDisputa = StatusPaymentRent::create([
            'estadoPagoRenta' => 'En disputa',
            'descripcion' => 'El estado de renta se encuentra en disputa debido a un desacuerdo entre el arrendador y el inquilino en cuanto al pago del alquiler',
        ]);

        $EstadoPagoRentaEnProcesoDesalojo = StatusPaymentRent::create([
            'estadoPagoRenta' => 'En proceso de desalojo',
            'descripcion' => 'El inquilino ha incumplido con sus obligaciones de pago y se ha iniciado el proceso de desalojo para recuperar la propiedad',
        ]);
    }
}
