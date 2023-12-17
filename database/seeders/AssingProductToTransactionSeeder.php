<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssingProductToTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaction::all();
        $products     = Product::all();
        $companies    = Company::all();

        foreach($transactions as $transaction)
        {
            $randomCompany = $companies->random();
            $randomProduct = $randomCompany->products()->inRandomOrder()->first();

            $randomProduct->transactions()->attach($transaction->id, ['company_id' => $randomCompany->id]);
        }
    }
}
