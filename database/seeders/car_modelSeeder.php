<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class car_modelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            // Brand, Model, Class_ID, Year, Fuel, Seats, Transmission
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
            ['BYD', 'Han EV', 3, 2024, 'Electric', 5, 'Automatic'],
            ['BYD', 'Atto 3', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Tesla', 'Model 3', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Tesla', 'Model Y', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Volkswagen', 'ID.4', 3, 2023, 'Electric', 5, 'Automatic'],
            ['Hyundai', 'IONIQ 5', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Kia', 'EV6', 3, 2024, 'Electric', 5, 'Automatic'],
            ['Kaiyi', 'X3 Pro EV', 3, 2024, 'Electric', 5, 'Automatic'],
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
        $i=0;
        foreach ($cars as $car) {
            // Using a search-based image URL for testing
            $searchTerm = urlencode($car[0] . ' ' . $car[1] . ' ' . $car[3]);
          $imageUrl = "https://source.unsplash.com/featured/800x600?{$searchTerm},car&sig=" . ($i + 1);

            DB::table('car_models')->insert([
                'brand'            => $car[0],
                'model_name'       => $car[1],
                'car_class'        => $car[2],
                'year'             => $car[3],
                'fuel_type'        => $car[4],
                'seating_capacity' => $car[5],
                'transmission'     => $car[6],
                // We use the live URL for development,
                // but you can keep your local path logic if you plan to download them later
                'image_path'       => $imageUrl,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
            $i++;
        }
    }
}
