<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'reservation_id' => Reservation::factory(),
            'vehicle_id' => Vehicle::factory(),
            'customer_id' => User::factory(),
            'total_amount' => fake()->randomFloat(0, 0, 99999999.),
            'actual_pickup_at' => fake()->dateTime(),
            'actual_return_at' => fake()->dateTime(),
            'pickup_location_id' => Location::factory(),
            'return_location_id' => Location::factory(),
            'status' => fake()->randomElement(["open",'closed']),
        ];
    }
}
