<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory(10)->has(Transaction::factory(2))->create();
    }
}
