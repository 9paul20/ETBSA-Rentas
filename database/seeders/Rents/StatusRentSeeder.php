<?php

namespace Database\Seeders\Rents;

use App\Models\Rents\StatusRent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusRentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // StatusRent::factory()
        //     ->count(25)
        //     ->create();

        $EstadoRentaPagado = StatusRent::create([
            'estadoRenta' => 'Pagado',
            'descripcion' => 'Este estado indica que el artículo o propiedad está pagado',
            'textColor' => 'text-green-600',
            'bgColorPrimary' => 'bg-green-50',
            'bgColorSecondary' => 'bg-green-600',
        ]);

        $EstadoRentaPendiente = StatusRent::create([
            'estadoRenta' => 'Pendiente',
            'descripcion' => 'Este estado indica que el artículo o propiedad está pendiente de pagar',
            'textColor' => 'text-orange-600',
            'bgColorPrimary' => 'bg-orange-50',
            'bgColorSecondary' => 'bg-orange-600',
        ]);

        $EstadoRentaCancelado = StatusRent::create([
            'estadoRenta' => 'Cancelado',
            'descripcion' => 'Este estado indica que el artículo o propiedad está cancelado',
            'textColor' => 'text-red-600',
            'bgColorPrimary' => 'bg-red-50',
            'bgColorSecondary' => 'bg-red-600',
        ]);
    }
}
