<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Pest\Support\Str;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $colors = ['White', 'Black', 'Silver', 'Grey', 'Blue', 'Red', 'Gold'];
        $statuses = ['Available', 'Rented', 'Maintenance', 'Reserved'];
        $municipalityCodes = [5, 6, 7, 8, 9, 13, 15]; // Tripoli, Khums, Sirte, Benghazi, etc.

        for ($i = 0; $i < 100; $i++) {
            // Randomly select municipality and generate plate: e.g., "5 - 123456"
            $plate = $municipalityCodes[array_rand($municipalityCodes)] . ' - ' . rand(100000, 999999);

            // Randomly select color and status
            $color = $colors[array_rand($colors)];

            DB::table('vehicles')->insert([
                'car_model'           => rand(1, 40), // Links to IDs 1-40 from CarModelSeeder
                'vin'                 => strtoupper(Str::random(17)), // Standard 17-char VIN
                'license_plate'       => $plate,
                'color'               => $color,
                'mileage'             => rand(0, 150000), // Range from new to used
                'price'               => rand(100, 400), // In LYD or USD depending on your app
                'status'              => "available",
                'current_location_id' => rand(1, 20), // Links to IDs 1-20 from LocationSeeder
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);
        }
    }
}
