<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'driver_license_number' => fake()->word(),
            'license_expiry_date' => fake()->date(),
            'date_of_birth' => fake()->dateTime(),
            'address' => fake()->word(),
        ];
    }
}
