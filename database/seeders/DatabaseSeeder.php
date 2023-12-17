<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\ToolSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\GroupSeeder;
use Database\Seeders\AssingUserRoleSeeder;
use Database\Seeders\FillTransactionTableSeeder;
use Database\Seeders\AssignCompanyToProductSeeder;
use Database\Seeders\AssignCompanyToServiceSeeder;
use Database\Seeders\AssingProductToTransactionSeeder;
use Database\Seeders\AssignServicesToTransactionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call(CompanySeeder::class);
       $this->call(RoleSeeder::class);
       $this->call(AssingUserRoleSeeder::class);
       $this->call(ServiceSeeder::class);
       $this->call(ProductSeeder::class);
    //    $this->call(CustomerSeeder::class);
       $this->call(GroupSeeder::class);
       $this->call(ToolSeeder::class);
       $this->call(RoomSeeder::class);
       $this->call(AssignCompanyToServiceSeeder::class);
       $this->call(AssignCompanyToProductSeeder::class);
       $this->call(AssignServicesToTransactionsSeeder::class);
       $this->call(AssingProductToTransactionSeeder::class);
       $this->call(FillTransactionTableSeeder::class);

    }
}
