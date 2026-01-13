<?php

namespace Database\Seeders;

use App\Models\CarModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class carmodels2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $cars = [
            // Brand, Model, Class_ID, Year, Fuel, Seats, Transmission
            // --- SEDANS (ID: 1) ---
            ['Toyota', 'Camry', 1, 2024, 'Petrol', 5, 'Automatic'],
            ['Toyota', 'Corolla', 1, 2023, 'Petrol', 5, 'Automatic'],
            ['Hyundai', 'Elantra', 1, 2024, 'Petrol', 5, 'Automatic'],
            ['Hyundai', 'Accent', 1, 2023, 'Petrol', 5, 'Automatic'],
            ['Kia', 'Cerato', 1, 2024, 'Petrol', 5, 'Automatic'],
            ['Kia', 'Pegas', 1, 2023, 'Petrol', 5, 'Automatic'],
            ['Nissan', 'Sunny', 1, 2024, 'Petrol', 5, 'Automatic'],
            ['Honda', 'Civic', 1, 2023, 'Petrol', 5, 'Automatic'],
            ['Chevrolet', 'Malibu', 1, 2024, 'Petrol', 5, 'Automatic'],
            ['Chery', 'Arrizo 5', 1, 2024, 'Petrol', 5, 'Automatic'],

            // --- SUVs (ID: 2) ---
            ['Toyota', 'Land Cruiser Prado', 2, 2024, 'Petrol', 7, 'Automatic'],
            ['Toyota', 'Hilux Double Cab', 2, 2023, 'Diesel', 5, 'Manual'],
            ['Hyundai', 'Tucson', 2, 2024, 'Petrol', 5, 'Automatic'],
            ['Hyundai', 'Santa Fe', 2, 2024, 'Petrol', 7, 'Automatic'],
            ['Kia', 'Sportage', 2, 2024, 'Petrol', 5, 'Automatic'],
            ['Kia', 'Sorento', 2, 2023, 'Petrol', 7, 'Automatic'],
            ['Nissan', 'Patrol', 2, 2024, 'Petrol', 8, 'Automatic'],
            ['Mitsubishi', 'Pajero', 2, 2023, 'Petrol', 7, 'Automatic'],
            ['Jetour', 'X70 Plus', 2, 2024, 'Petrol', 7, 'Automatic'],
            ['Chery', 'Tiggo 8 Pro', 2, 2024, 'Petrol', 7, 'Automatic'],
            ['GAC', 'GS8', 2, 2024, 'Petrol', 7, 'Automatic'],
            ['Ford', 'Explorer', 2, 2023, 'Petrol', 7, 'Automatic'],
            ['Jeep', 'Grand Cherokee', 2, 2024, 'Petrol', 5, 'Automatic'],

            // --- ELECTRIC (ID: 3) ---
            ['BYD', 'Han EV', 3, 2024, 'Electric', 5, 'Automatic'],
            ['BYD', 'Atto 3', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Tesla', 'Model 3', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Tesla', 'Model Y', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Volkswagen', 'ID.4', 3, 2023, 'Electric', 5, 'Automatic'],
            ['Hyundai', 'IONIQ 5', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Kia', 'EV6', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Kaiyi', 'X3 Pro EV', 3, 2024, 'Electric', 5, 'Automatic'],

            // --- LUXURY (ID: 4) ---
            ['Mercedes-Benz', 'S-Class', 4, 2024, 'Petrol', 5, 'Automatic'],
            ['Mercedes-Benz', 'GLE 53 AMG', 4, 2024, 'Petrol', 5, 'Automatic'],
            ['BMW', '7 Series', 4, 2024, 'Petrol', 5, 'Automatic'],
            ['BMW', 'X5', 4, 2024, 'Petrol', 5, 'Automatic'],
            ['Audi', 'A8', 4, 2024, 'Petrol', 5, 'Automatic'],
            ['Range Rover', 'Vogue', 4, 2024, 'Petrol', 5, 'Automatic'],
            ['Lexus', 'LX 600', 4, 2024, 'Petrol', 7, 'Automatic'],
            ['Porsche', 'Cayenne', 4, 2024, 'Petrol', 5, 'Automatic'],
            ['Cadillac', 'Escalade', 4, 2023, 'Petrol', 7, 'Automatic'],
        ];

        foreach ($cars as $car) {
            DB::table('car_models')->insert([
                'brand'            => $car[0],
                'model_name'       => $car[1],
                'car_class'        => $car[2], // ID: 1, 2, 3, or 4
                'year'             => $car[3],
                'fuel_type'        => $car[4],
                'seating_capacity' => $car[5],
                'transmission'     => $car[6],
                'image_path'       => 'images/cars/' . strtolower(str_replace(' ', '-', $car[0] . '-' . $car[1])) . '.jpg',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}
