<?php

namespace Database\Seeders\Rents;

use App\Models\Rents\PaymentRent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentRentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentRent::factory()
            ->count(15)
            ->create();
    }
}