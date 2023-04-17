<?php

namespace Database\Seeders\Persons;

use App\Models\Persons\Nacionalidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NacionalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nacionalidad::factory()
            ->count(15)
            ->create();
    }
}