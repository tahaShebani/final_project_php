<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceReportFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::factory(),
            'employee_id' => User::factory(),
            'entered_at' => fake()->dateTime(),
            'exited_at' => fake()->dateTime(),
            'cost' => fake()->randomFloat(0, 0, 9999999.),
            'descriptopn' => fake()->text(300)
        ];
    }
}
