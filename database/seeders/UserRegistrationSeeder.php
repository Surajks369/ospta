<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\UserRegistration::insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'date_of_birth' => '1990-01-01',
                'gender' => 'male',
                'address' => '123 Main St',
                'city' => 'New York',
                'state' => 'NY',
                'pincode' => '10001',
                'qualification' => 'B.Sc',
                'image' => 'users/john.jpg',
                'notes' => 'Interested in programming.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '9876543210',
                'date_of_birth' => '1992-05-15',
                'gender' => 'female',
                'address' => '456 Elm St',
                'city' => 'Los Angeles',
                'state' => 'CA',
                'pincode' => '90001',
                'qualification' => 'M.A.',
                'image' => 'users/jane.jpg',
                'notes' => 'Interested in design.',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
