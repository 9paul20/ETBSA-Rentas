<?php

namespace Database\Seeders\FixedExpenses;

use App\Models\FixedExpenses\TypeFixedExpense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeFixedExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $TipoGastoFijo1 = TypeFixedExpense::create([
            'TipogastoFijo' => 'Comisión de Apertura',
            'descripcion' => 'Descripción de Comisión de Apertura',
        ]);

        $TipoGastoFijo2 = TypeFixedExpense::create([
            'TipogastoFijo' => 'Flete',
            'descripcion' => 'Descripción de Flete',
        ]);

        $TipoGastoFijo3 = TypeFixedExpense::create([
            'TipogastoFijo' => 'Gastos de x',
            'descripcion' => 'Descripción de Gastos de x',
        ]);

        $TipoGastoFijo4 = TypeFixedExpense::create([
            'TipogastoFijo' => 'Seguro',
            'descripcion' => 'Descripción de Seguro',
        ]);

        $TipoGastoFijo5 = TypeFixedExpense::create([
            'TipogastoFijo' => 'Interés del Plazo a Pedir',
            'descripcion' => 'Descripción de Interés del Plazo a Pedir',
        ]);

        $TipoGastoFijo6 = TypeFixedExpense::create([
            'TipogastoFijo' => 'GPS Anualidad',
            'descripcion' => 'Descripción de GPS Anualidad',
        ]);

        $TipoGastoFijo7 = TypeFixedExpense::create([
            'TipogastoFijo' => 'Garantia Extendida',
            'descripcion' => 'Descripción de Garantia Extendida',
        ]);
    }
}
