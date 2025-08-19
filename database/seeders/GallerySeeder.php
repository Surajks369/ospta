<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Gallery::insert([
            [
                'title' => 'Classroom Session',
                'description' => 'Live classroom session photo.',
                'image' => 'gallery/classroom.jpg',
                'type' => 'image',
                'video_url' => null,
                'status' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Course Introduction',
                'description' => 'Introductory video for Laravel course.',
                'image' => 'gallery/intro.jpg',
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/watch?v=example',
                'status' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
