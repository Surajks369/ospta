<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Testimonial::insert([
            [
                'name' => 'Alice Brown',
                'designation' => 'Developer',
                'company' => 'TechCorp',
                'testimonial' => 'Great platform for learning!',
                'image' => 'testimonials/alice.jpg',
                'rating' => 5,
                'status' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Green',
                'designation' => 'Designer',
                'company' => 'DesignPro',
                'testimonial' => 'Loved the design courses!',
                'image' => 'testimonials/bob.jpg',
                'rating' => 4,
                'status' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
