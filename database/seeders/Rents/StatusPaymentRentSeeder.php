<?php

namespace Database\Seeders\Rents;

use App\Models\Rents\StatusPaymentRent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPaymentRentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusPaymentRent::factory()
            ->count(15)
            ->create();
    }
}