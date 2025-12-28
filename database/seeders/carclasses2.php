<?php

namespace Database\Seeders;

use App\Models\CarClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class carclasses2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarClass::insert([
    ['class' => 'suv', 'image_path' => 'cars/suv.jpg'],
    ['class' => 'sedan', 'image_path' => 'cars/sedan.jpg'],
    ['class' => 'luxury', 'image_path' => 'cars/luxury.jpg'],
    ['class' => 'electric', 'image_path' => 'cars/electric.jpg'],
]);
    }
}
