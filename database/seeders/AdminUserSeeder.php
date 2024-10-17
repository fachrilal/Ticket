<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('admin221'), // Password terenkripsi
            'role' => 'admin', // Set role as admin
        ]);
        User::create([
            'name' => 'Admin User',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('admin2214'), // Password terenkripsi
            'role' => 'admin', // Set role as admin
        ]);
    }
}
