<?php

namespace Database\Seeders\Equipments;

use App\Models\Equipments\TypeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeCategory::factory()
            ->count(15)
            ->create();
    }
}