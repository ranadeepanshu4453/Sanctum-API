<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'email'=>$this->faker->email,
            'password'=>bcrypt('password'),
            'number'=>$this->faker->phoneNumber,
            'company'=>$this->faker->company,
            'DOB'=>$this->faker->dateTimeBetween('-30 years', '-18 years'),
            'latitude'=>$this->faker->latitude,
            'longitude'=>$this->faker->longitude,

        ];
    }
}
