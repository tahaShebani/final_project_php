<?php

namespace Database\Seeders;

use App\Models\CarModel;
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
            // SUV (Class 1)
            ['car_class' => 1, 'brand' => 'Toyota', 'model_name' => 'Land Cruiser', 'year' => '2024', 'fuel_type' => 'Diesel', 'transmission' => 'Automatic', 'seating_capacity' => 7,"doors"=>4,"luggage_capacity"=>5,"price"=>100, 'image_path' => 'https://images.unsplash.com/photo-1594502184342-2e12f877aa73?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 1, 'brand' => 'Jeep', 'model_name' => 'Wrangler', 'year' => '2023', 'fuel_type' => 'Petrol', 'transmission' => 'Manual', 'seating_capacity' => 5,"doors"=>4,"luggage_capacity"=>5, "price"=>100, 'image_path' => 'https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 1, 'brand' => 'Ford', 'model_name' => 'Explorer', 'year' => '2022', 'fuel_type' => 'Petrol', 'transmission' => 'Automatic', 'seating_capacity' => 7,"doors"=>4,"luggage_capacity"=>5,"price"=>100, 'image_path' => 'https://images.unsplash.com/photo-1566008885218-90abf9200ddb?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 1, 'brand' => 'Nissan', 'model_name' => 'Patrol', 'year' => '2024', 'fuel_type' => 'Petrol', 'transmission' => 'Automatic', 'seating_capacity' => 8,"doors"=>4,"luggage_capacity"=>5,"price"=>100, 'image_path' => 'https://images.unsplash.com/photo-1621932953986-15fcfec8327c?auto=format&fit=crop&q=80&w=800'],

            // Sedan (Class 2)
            ['car_class' => 2, 'brand' => 'Honda', 'model_name' => 'Civic', 'year' => '2023', 'fuel_type' => 'Hybrid', 'transmission' => 'CVT', 'seating_capacity' => 5,"doors"=>4,"luggage_capacity"=>5, "price"=>100,'image_path' => 'https://images.unsplash.com/photo-1590362891991-f776e747a588?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 2, 'brand' => 'BMW', 'model_name' => '5 Series', 'year' => '2024', 'fuel_type' => 'Petrol', 'transmission' => 'Automatic', 'seating_capacity' => 5,"luggage_capacity"=>5,"doors"=>4,"price"=>100, 'image_path' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 2, 'brand' => 'Audi', 'model_name' => 'A6', 'year' => '2022', 'fuel_type' => 'Diesel', 'transmission' => 'Automatic', 'seating_capacity' => 5,"luggage_capacity"=>5,"doors"=>4, "price"=>100,'image_path' => 'https://images.unsplash.com/photo-1606152424101-ad9296f333a9?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 2, 'brand' => 'Toyota', 'model_name' => 'Camry', 'year' => '2024', 'fuel_type' => 'Hybrid', 'transmission' => 'Automatic', 'seating_capacity' => 5,"luggage_capacity"=>5,"doors"=>4, "price"=>100,'image_path' => 'https://images.unsplash.com/photo-1621007947382-bb3c3994e3fb?auto=format&fit=crop&q=80&w=800'],

            // Luxury (Class 3)
            ['car_class' => 3, 'brand' => 'Mercedes', 'model_name' => 'G-Wagon', 'year' => '2024', 'fuel_type' => 'Petrol', 'transmission' => 'Automatic', 'seating_capacity' => 5,"luggage_capacity"=>5,"doors"=>4,"price"=>100, 'image_path' => 'https://images.unsplash.com/photo-1520031441872-265e4ff70366?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 3, 'brand' => 'Rolls Royce', 'model_name' => 'Phantom', 'year' => '2023', 'fuel_type' => 'Petrol', 'transmission' => 'Automatic', 'seating_capacity' => 4,"luggage_capacity"=>5,"doors"=>4,"price"=>100, 'image_path' => 'https://images.unsplash.com/photo-1631214548474-246d83831bc1?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 3, 'brand' => 'Bentley', 'model_name' => 'Continental', 'year' => '2024', 'fuel_type' => 'Petrol', 'transmission' => 'Automatic', 'seating_capacity' => 4,"luggage_capacity"=>5,"doors"=>4,"price"=>100, 'image_path' => 'https://images.unsplash.com/photo-1621135802920-133df287f89c?auto=format&fit=crop&q=80&w=800'],

            // Electric (Class 4)
            ['car_class' => 4, 'brand' => 'Tesla', 'model_name' => 'Model X', 'year' => '2024', 'fuel_type' => 'Electric', 'transmission' => 'Automatic', 'seating_capacity' => 6,"luggage_capacity"=>5,"doors"=>4, "price"=>100,'image_path' => 'https://images.unsplash.com/photo-1561580119-64628491da2d?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 4, 'brand' => 'Porsche', 'model_name' => 'Taycan', 'year' => '2023', 'fuel_type' => 'Electric', 'transmission' => 'Automatic', 'seating_capacity' => 4,"luggage_capacity"=>5,"doors"=>4,"price"=>100, 'image_path' => 'https://images.unsplash.com/photo-1614162692292-7ac56d7f7f1e?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 4, 'brand' => 'Hyundai', 'model_name' => 'IONIQ 5', 'year' => '2024', 'fuel_type' => 'Electric', 'transmission' => 'Automatic', 'seating_capacity' => 5,"luggage_capacity"=>5,"doors"=>4, "price"=>100,'image_path' => 'https://images.unsplash.com/photo-1664115160913-644917646545?auto=format&fit=crop&q=80&w=800'],
            ['car_class' => 4, 'brand' => 'Rivian', 'model_name' => 'R1S', 'year' => '2024', 'fuel_type' => 'Electric', 'transmission' => 'Automatic', 'seating_capacity' => 7,"luggage_capacity"=>5,"doors"=>4, "price"=>100,'image_path' => 'https://images.unsplash.com/photo-1681239920194-e356c9b5f543?auto=format&fit=crop&q=80&w=800'],
        ];

        foreach ($cars as $car) {
            CarModel::updateOrCreate(
                ['brand' => $car['brand'], 'model_name' => $car['model_name']], // Prevents duplicates if you run it twice
                $car
            );
        }
    }
}
