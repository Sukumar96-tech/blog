<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed admin users
        $this->call(AdminSeeder::class);

        // Seed sample blogs
        $this->call(BlogSeeder::class);
    }
}
