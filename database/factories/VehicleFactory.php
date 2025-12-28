<?php

namespace Database\Factories;

use App\Models\CarModel;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'car_model' => CarModel::factory(),
           'vin' => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'license_plate' => $this->faker->unique()->bothify('??-####-??'),
            'color' => fake()->word(),
            'mileage' => fake()->numberBetween(0, 200000),
            'price' => fake()->randomFloat(0, 0, 9999999.),
            'status' => fake()->randomElement(["available",'reserved','rented','maintenance']),
            'reserved_until' => fake()->dateTime(),
            'current_location_id' => Location::factory(),
        ];
    }
}
