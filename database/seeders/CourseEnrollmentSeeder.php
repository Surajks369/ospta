<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CourseEnrollment::insert([
            [
                'course_id' => 1,
                'user_registration_id' => 1,
                'enrollment_date' => now()->subDays(5),
                'amount_paid' => 79.99,
                'payment_method' => 'Credit Card',
                'payment_reference' => 'TXN123456',
                'payment_status' => 'completed',
                'enrollment_status' => 'active',
                'start_date' => now()->subDays(5),
                'end_date' => now()->addWeeks(4),
                'progress_percentage' => 25,
                'notes' => 'Good progress.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'user_registration_id' => 2,
                'enrollment_date' => now()->subDays(2),
                'amount_paid' => 129.99,
                'payment_method' => 'PayPal',
                'payment_reference' => 'TXN654321',
                'payment_status' => 'pending',
                'enrollment_status' => 'active',
                'start_date' => now()->subDays(2),
                'end_date' => now()->addWeeks(6),
                'progress_percentage' => 10,
                'notes' => 'Just started.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
