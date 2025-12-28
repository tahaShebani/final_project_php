<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'customer_id' => User::factory(),
            'vehicle_id' => Vehicle::factory(),
            'pickup_location_id' => Location::factory(),
            'dropoff_location_id' => Location::factory(),
            'reserved_at' => fake()->dateTime(),
            'expires_at' => fake()->dateTime(),
            'pickup_date' => fake()->dateTime(),
            'return_date' => fake()->dateTime(),
            'status' => fake()->randomElement(["pending",'confirmed','cancelled']),
            'total_price' => fake()->randomFloat(0, 0, 9999999.),
        ];
    }
}
