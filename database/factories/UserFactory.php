<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->word(),
            'email' => fake()->safeEmail(),
            'password'  => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => fake()->randomElement(['operation_employee','booking_agent','customer']),
            'phone_number' => fake()->phoneNumber(),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
