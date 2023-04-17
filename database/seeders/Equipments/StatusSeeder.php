<?php

namespace Database\Seeders\Equipments;

use App\Models\Equipments\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::factory()
            ->count(15)
            ->create();
    }
}