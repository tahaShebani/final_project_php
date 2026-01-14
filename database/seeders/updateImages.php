<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class updateImages extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carImages = [
            1 => 'carModels/01KEWGWSZTNHVRDFSPQTCKDW0P.jpg',
            2 => 'carModels/01KEWGXQT10YCGFSW1AN77NVAJ.jpg',
            3 => 'carModels/01KEWGYCXHEA3VX3RR309J2VKC.jpg',
            4 => 'carModels/01KEWGZBQ4HAYZGX0NHR6RD1SD.jpg',
            5 => 'carModels/01KEWH3DS322BXHWJHX2EJ6EJP.jpg',
            6 => 'carModels/01KEWH4PVKPQH7VJSN6QR9J5H5.jpg',
            7 => 'carModels/01KEWH5Q20CCYMQZGZRE9FY63A.jpg',
            8 => 'carModels/01KEWH71YNNZ2716SGQHZTXC3Q.jpg',
            9 => 'carModels/01KEWH8DP23YAEZSCBZ1FMFQ6N.jpg',
            10 => 'carModels/01KEWH9Q28FK3M0YEGWCP8268H.jpg',
            11 => 'carModels/01KEWHAFSP2W7HPGW3N7V4APDF.jpg',
            12 => 'carModels/01KEWHBXM35983VYTB48SY46ZJ.jpg',
            13 => 'carModels/01KEWHCXFM4PF0ETD62KTHDKKW.jpg',
            14 => 'carModels/01KEWHDT9W3E5T1HM37501KRMY.jpg',
            15 => 'carModels/01KEWHES95E6BVBNQMMA8T1Y9P.jpg',
            16 => 'carModels/01KEWHFRYXKG8ZC98A0MZYZX0N.jpg',
            17 => 'carModels/01KEWHGV75GY4GN7B787XNM2EZ.jpg',
            18 => 'carModels/01KEWHJ0TKHSNCE7XFBXFPADQB.jpg',
            19 => 'carModels/01KEWHM87WZJSN9EBJ4YT410W4.jpg',
            20 => 'carModels/01KEWHMXKAMQS2NJ1225N3RPW4.jpg',
            21 => 'carModels/01KEWHNTHEAS40DHW8VR7KMEPZ.jpg',
            22 => 'carModels/01KEWHPJHZQ0VWDJTR77XQ45XJ.jpg',
            23 => 'carModels/01KEWHQEPHP73SHY3SERQHCJ18.jpg',
            24 => 'carModels/01KEWHRXD9GMGPKN8HRZ7Y5ME8.jpg',
            25 => 'carModels/01KEWHTNX7V0EBA7ZNG5YQBVQY.jpg',
            26 => 'carModels/01KEWHW2QQM05W9S7FV82KE2M7.jpg',
            27 => 'carModels/01KEWHWWBEXC44RNXNKJ49TZB2.jpg',
            28 => 'carModels/01KEWHXRSG9VPY1B0QH1BR025E.jpg',
            29 => 'carModels/01KEWHYMQV8TM62N6XD2ABPWBQ.jpg',
            30 => 'carModels/01KEWJ02AR436XSMR7K4JVYBM5.jpg',
            31 => 'carModels/01KEWJ0XMBEHKJQ2AWJT8DGZN7.jpg',
            32 => 'carModels/01KEWJ34D3VRY8BVP20WTRYC64.jpg',
            33 => 'carModels/01KEWJ4AEER53J1QVBEA8JSTAH.jpg',
            34 => 'carModels/01KEWJ5445H6J7VDK72WXZ43WD.jpg',
            35 => 'carModels/01KEWJ685MPYMW3EXQ62MGWAM2.jpg',
            36 => 'carModels/01KEWJ6ZRSCZ41K88Y55D83AE3.jpg',
            37 => 'carModels/01KEWJ8MVXEJNYWDWVV88J12KC.jpg',
            38 => 'carModels/01KEWJ9R937V8ND0S78TK31SW5.jpg',
            39 => 'carModels/01KEWJAV2NMS79XHW4SF7A5JN2.jpg',
            40 => 'carModels/01KEWJC275WA4YJZAFG1ZZ1QFC.jpg',
        ];

        foreach ($carImages as $id => $path) {
            DB::table('car_models')
                ->where('id', $id)
                ->update(['image_path' => $path]);
        }
    }
}
