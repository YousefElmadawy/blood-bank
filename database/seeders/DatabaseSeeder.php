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
        // Order matters! Run in this sequence:
        // 1. First create roles and permissions
        $this->call(PermissionTableSeeder::class);

        // 2. Then create users and assign roles
        $this->call(UserSeeder::class);

        // 3. Then create other data
        $this->call(BloodTypeSeeder::class);
    }
}
