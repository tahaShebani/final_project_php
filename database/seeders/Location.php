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
$locations = [
            ['name' => 'طرابلس - ميدان الشهداء', 'lat' => 32.8966, 'lng' => 13.1822],
            ['name' => 'بنغازي - فندق تيبستي', 'lat' => 32.1147, 'lng' => 20.0686],
            ['name' => 'مصراتة - وسط المدينة', 'lat' => 32.3754, 'lng' => 15.0925],
            ['name' => 'الزاوية - ميدان النصر', 'lat' => 32.7522, 'lng' => 12.7247],
            ['name' => 'البيضاء - جامعة عمر المختار', 'lat' => 32.7628, 'lng' => 21.7551],
            ['name' => 'طبرق - ميناء طبرق', 'lat' => 32.0836, 'lng' => 23.9764],
            ['name' => 'سبها - قلعة سبها', 'lat' => 27.0377, 'lng' => 14.4283],
            ['name' => 'غريان - حوش الحفر', 'lat' => 32.1691, 'lng' => 13.0128],
            ['name' => 'صبراتة - الآثار الرومانية', 'lat' => 32.7932, 'lng' => 12.4822],
            ['name' => 'زليتن - منارة عبد السلام الأسمر', 'lat' => 32.4674, 'lng' => 14.5687],
            ['name' => 'الخمس - لبدة الكبرى', 'lat' => 32.6500, 'lng' => 14.2833],
            ['name' => 'درنة - شلال درنة', 'lat' => 32.7558, 'lng' => 22.6294],
            ['name' => 'سرت - مجمع قادقادو', 'lat' => 31.2089, 'lng' => 16.5887],
            ['name' => 'اجدابيا - وسط المدينة', 'lat' => 30.7554, 'lng' => 20.2263],
            ['name' => 'غدامس - المدينة القديمة', 'lat' => 30.1333, 'lng' => 9.4833],
            ['name' => 'ترهونة - منطقة الشرشاره', 'lat' => 32.4350, 'lng' => 13.6332],
            ['name' => 'يفرن - وسط الجبل', 'lat' => 32.0625, 'lng' => 12.5258],
            ['name' => 'بني وليد - وادي سوف الجين', 'lat' => 31.7565, 'lng' => 13.9942],
            ['name' => 'الكفرة - واحة الكفرة', 'lat' => 24.2140, 'lng' => 23.2857],
            ['name' => 'شحات - معبد أبولو', 'lat' => 32.8222, 'lng' => 21.8556],
        ];

        foreach ($locations as $loc) {
            DB::table('locations')->insert([
                'name'       => $loc['name'],
                'address'    => $loc['name'] . '، ليبيا',
                'latitude'   => $loc['lat'],
                'longitude'  => $loc['lng'],
                'map_link'   => "https://www.google.com/maps/?q={$loc['lat']},{$loc['lng']}",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
