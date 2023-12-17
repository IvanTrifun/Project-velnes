<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Tool;
// use App\Models\Event;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ->has(Event::factory(10))
        Service::factory(20)->create();
    }
}
