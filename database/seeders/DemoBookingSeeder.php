<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DemoBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\DemoBooking::insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'course_id' => 1,
                'preferred_date' => now()->addDays(2),
                'preferred_time' => '10:00',
                'message' => 'Looking for a demo session.',
                'status' => 'pending',
                'admin_notes' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '9876543210',
                'course_id' => 2,
                'preferred_date' => now()->addDays(3),
                'preferred_time' => '14:00',
                'message' => 'Interested in design demo.',
                'status' => 'confirmed',
                'admin_notes' => 'Confirmed for Friday.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
