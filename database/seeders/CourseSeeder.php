<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Course::insert([
            [
                'title' => 'Laravel for Beginners',
                'slug' => 'laravel-for-beginners',
                'description' => 'Learn the basics of Laravel framework.',
                'short_description' => 'Laravel basics course.',
                'category_id' => 1,
                'image' => 'courses/laravel.jpg',
                'price' => 99.99,
                'discounted_price' => 79.99,
                'duration' => '4 weeks',
                'level' => 'Beginner',
                'features' => json_encode(['Certificate', 'Projects']),
                'status' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'UI/UX Design Masterclass',
                'slug' => 'ui-ux-design-masterclass',
                'description' => 'Master UI/UX design principles.',
                'short_description' => 'UI/UX design course.',
                'category_id' => 2,
                'image' => 'courses/uiux.jpg',
                'price' => 149.99,
                'discounted_price' => 129.99,
                'duration' => '6 weeks',
                'level' => 'Intermediate',
                'features' => json_encode(['Portfolio', 'Mentorship']),
                'status' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
