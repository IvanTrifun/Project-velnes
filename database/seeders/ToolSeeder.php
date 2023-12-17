<?php

namespace Database\Seeders;

use App\Models\Tool;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tool::factory(10)->create();
    }
}
