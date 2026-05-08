<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user
        Admin::firstOrCreate(
            ['email' => 'admin@bloghub.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@bloghub.com',
                'password' => Hash::make('password123'),
            ]
        );

        // Create additional test admin
        Admin::firstOrCreate(
            ['email' => 'test@bloghub.com'],
            [
                'name' => 'Test Admin',
                'email' => 'test@bloghub.com',
                'password' => Hash::make('test123'),
            ]
        );
    }
}
