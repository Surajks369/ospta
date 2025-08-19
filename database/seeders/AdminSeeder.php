<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Admin::create([
            'name' => 'Admin User',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password123'),
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
