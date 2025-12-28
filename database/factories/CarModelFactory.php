<?php

namespace Database\Factories;

use App\Models\CarClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarModelFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'car_class' => CarClass::factory(),
            'brand' => fake()->word(),
            'model_name' => fake()->word(),
            'year' => fake()->word(),
            'fuel_type' => fake()->word(),
            'transmission' => fake()->word(),
            'seating_capacity' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
