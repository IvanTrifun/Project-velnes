<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['role_type' => 'Admin']);
        Role::create(['role_type' => 'CompanyAdmin']);
        Role::create(['role_type' => 'Employee']);
    }
}
