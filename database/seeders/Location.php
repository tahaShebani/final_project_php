<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class Location extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
            $lat = $faker->latitude();
            $long = $faker->longitude();

            DB::table('locations')->insert([
                'name' => $faker->company() . ' Office',
                'address' => $faker->address(),
                'latitude' => $lat,
                'longitude' => $long,
                'map_link' => "https://www.google.com/maps/search/?api=1&query={$lat},{$long}",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
