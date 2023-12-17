<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_name' => $this->faker->word,
            'company_id'=> $this->randomCompany()->id
        ];
    }

    public function randomCompany(){
        $company = Company::all();

        return $company->random();
    }
}
