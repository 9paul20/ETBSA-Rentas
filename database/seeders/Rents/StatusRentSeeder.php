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
        StatusRent::factory()
            ->count(25)
            ->create();
    }
}