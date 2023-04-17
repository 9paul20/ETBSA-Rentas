<?php

namespace Database\Seeders\Persons;

use App\Models\Persons\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nationality::factory()
            ->count(25)
            ->create();
    }
}