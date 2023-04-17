<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Persons
        $this->call(Persons\ComTelSeeder::class);
        $this->call(Persons\NacionalidadSeeder::class);

        //Equipments
        $this->call(Equipments\StatusSeeder::class);
        $this->call(Equipments\TypeCategorySeeder::class);
        $this->call(Equipments\CategorySeeder::class);

        $this->call(EquipmentSeeder::class);

        //Users con Persons, Roles Y Permissions
        $this->call(UserSeeder::class);
    }
}