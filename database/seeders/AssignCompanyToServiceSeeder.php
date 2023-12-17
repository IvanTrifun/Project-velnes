<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignCompanyToServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $services  = Service::all();

        foreach($companies as $company){
            foreach($services as $service){
                $company->services()->attach($service->id, ['price' => rand(50, 500)]);
            }
        }
    }
}
