<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class InspectionReportFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::factory(),
            'reservation_id' => Reservation::factory(),
            'inspector_id' => User::factory(),
            'type' => fake()->randomElement(["pickup",'return']),
            'fuel_level' => fake()->numberBetween(0, 100),
            'mileage' => fake()->numberBetween(0, 300000),
            'status' => fake()->randomElement(["excellent",'good','fair','needs_cleaning','needs_maintenance','out_of_service']),
            'notes' => fake()->text(),
        ];
    }
}
