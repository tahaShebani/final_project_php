<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'employee_id' => fake()->numberBetween(0, 100000),
            'department' => fake()->word(),
            'hire_date' => fake()->date(),
            'job_title' => fake()->word(),
            'location_id' => Location::factory(),
        ];
    }
}
