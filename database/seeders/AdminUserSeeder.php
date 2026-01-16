<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@admin.com',
            'phone_number' => '123456789',
            'role' => 'admin', 
            'password' => Hash::make('admin1234'),
            'email_verified_at' => now(),
        ]);
    }
}
