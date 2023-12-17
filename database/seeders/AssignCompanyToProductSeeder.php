<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignCompanyToProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $products  = Product::all();

        foreach($companies as $company)
        {
            for($i=0; $i<4; $i++)
            {
                $randomProduct = $products->random();

                $company->products()->attach($randomProduct->id, ['price' => rand(50, 500), 'stock'=>rand(1,20)]);
            }
       }
    }
}
