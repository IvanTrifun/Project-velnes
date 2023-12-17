<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name.' '. $this->faker->lastName,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // random password hash
            'email' => $this->faker->email,
            'profile_picture' =>$this->faker->imageUrl(width:50, height:50),
        ];
        // $2y$12$/8uzHqCw9RU15CAVJUw1AuzxNzhavtIptHGL2mZgdLrTIayyqvAyG
    }
}
