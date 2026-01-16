<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'id' => 1,
                'name' => 'طرابلس',
                'address' => 'طرابلس، ليبيا',
                'latitude' => 32.8872,
                'longitude' => 13.1913,
                'map_link' => 'https://www.google.com/maps/search/?api=1&query=32.8872,13.1913',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'بنغازي',
                'address' => 'بنغازي، ليبيا',
                'latitude' => 32.1167,
                'longitude' => 20.0667,
                'map_link' => 'https://www.google.com/maps/search/?api=1&query=32.1167,20.0667',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
