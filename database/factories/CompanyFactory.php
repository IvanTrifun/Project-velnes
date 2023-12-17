<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($this->faker));

        return [
            'company_name' => $this->faker->company,
            'work_number' => $this->faker->phoneNumber,
            'address'=> $this->faker->address,
            'city' => $this->faker->city,
            'email' => $this->faker->email,
            'postal_code'=>rand(1000,10000),
            'logo' =>$this->faker->imageUrl(width:100, height:100),
        ];
    }
}
