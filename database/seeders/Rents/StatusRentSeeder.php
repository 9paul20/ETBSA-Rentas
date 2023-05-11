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
            'estadoRenta' => 'Finalizado',
            'descripcion' => 'Este estado indica que el artículo, equipo o propiedad está pagado',
            'textColor' => 'text-green-600',
            'bgColorPrimary' => 'bg-green-50',
            'bgColorSecondary' => 'bg-green-600',
        ]);

        $EstadoRentaEnRenta = StatusRent::create([
            'estadoRenta' => 'En Renta',
            'descripcion' => 'Este estado indica que el artículo, equipo o propiedad está en renta',
            'textColor' => 'text-yellow-600',
            'bgColorPrimary' => 'bg-yellow-50',
            'bgColorSecondary' => 'bg-yellow-600',
        ]);

        $EstadoRentaEnMora = StatusRent::create([
            'estadoRenta' => 'En Mora',
            'descripcion' => 'Este estado indica que el artículo, equipo o propiedad está en mora',
            'textColor' => 'text-orange-600',
            'bgColorPrimary' => 'bg-orange-50',
            'bgColorSecondary' => 'bg-orange-600',
        ]);

        $EstadoRentaPendiente = StatusRent::create([
            'estadoRenta' => 'Pendiente',
            'descripcion' => 'Este estado indica que el artículo, equipo o propiedad está pendiente de pagar',
            'textColor' => 'text-orange-600',
            'bgColorPrimary' => 'bg-orange-50',
            'bgColorSecondary' => 'bg-orange-600',
        ]);

        $EstadoRentaProceso = StatusRent::create([
            'estadoRenta' => 'En Proceso',
            'descripcion' => 'Este estado indica que el artículo, equipo o propiedad está en proceso de rentar',
            'textColor' => 'text-orange-600',
            'bgColorPrimary' => 'bg-orange-50',
            'bgColorSecondary' => 'bg-orange-600',
        ]);

        $EstadoRentaCancelado = StatusRent::create([
            'estadoRenta' => 'Cancelado',
            'descripcion' => 'Este estado indica que el artículo, equipo o propiedad está cancelado',
            'textColor' => 'text-red-600',
            'bgColorPrimary' => 'bg-red-50',
            'bgColorSecondary' => 'bg-red-600',
        ]);
    }
}