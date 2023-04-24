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
        ]);

        $EstadoRentaPendiente = StatusRent::create([
            'estadoRenta' => 'Pendiente',
            'descripcion' => 'Este estado indica que el artículo o propiedad está pendiente de pagar',
        ]);

        $EstadoRentaCancelado = StatusRent::create([
            'estadoRenta' => 'Cancelado',
            'descripcion' => 'Este estado indica que el artículo o propiedad está cancelado',
        ]);
    }
}
