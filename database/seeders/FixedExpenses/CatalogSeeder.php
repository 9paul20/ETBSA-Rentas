<?php

namespace Database\Seeders\FixedExpenses;

use App\Models\FixedExpenses\Catalog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gastos Fijos
        $GastoFijo1 = Catalog::create([
            'gastoFijo' => 'Comisión de Apertura',
            'descripcion' => 'Descripción de Comisión de Apertura',
        ]);
        $GastoFijo1->save();

        $GastoFijo2 = Catalog::create([
            'gastoFijo' => 'Flete',
            'descripcion' => 'Descripción de Flete',
        ]);
        $GastoFijo2->save();

        $GastoFijo3 = Catalog::create([
            'gastoFijo' => 'Gastos de x',
            'descripcion' => 'Descripción de Gastos de x',
        ]);
        $GastoFijo3->save();

        $GastoFijo4 = Catalog::create([
            'gastoFijo' => 'Seguro Inicial',
            'descripcion' => 'Descripción de Seguro Inicial',
        ]);
        $GastoFijo4->save();

        $GastoFijo5 = Catalog::create([
            'gastoFijo' => 'Interés del Plazo a Pedir',
            'descripcion' => 'Descripción de Interés del Plazo a Pedir',
        ]);
        $GastoFijo5->save();

        $GastoFijo6 = Catalog::create([
            'gastoFijo' => 'GPS Anualidad',
            'descripcion' => 'Descripción de GPS Anualidad',
        ]);
        $GastoFijo6->save();

        $GastoFijo7 = Catalog::create([
            'gastoFijo' => 'Garantia Extendida',
            'descripcion' => 'Descripción de Garantia Extendida',
        ]);
        $GastoFijo7->save();
    }
}
