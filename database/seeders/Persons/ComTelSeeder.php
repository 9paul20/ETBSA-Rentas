<?php

namespace Database\Seeders\Persons;

use App\Models\Persons\ComTel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComTelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComTel::factory()
            ->count(25)
            ->create();
    }
}