<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $groups = Group::factory(4)->create();
        $companies=Company::all();


        $groups->each(function ($group) use($companies){
            $customers = Customer::factory(5)->create(['group_id' => $group->id]);

            $customers->each(function ($customer) use ($companies){
                $randomCompany=$companies->random();
                $customer->company_id=$randomCompany->id;
                $customer->save();
                $customer->transactions()->saveMany(Transaction::factory(2)->make());
            });


        });
    }
}
