<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::insert([
            [
                'name' => 'Programming',
                'slug' => 'programming',
                'description' => 'Programming courses and tutorials.',
                'image' => 'categories/programming.jpg',
                'status' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Design',
                'slug' => 'design',
                'description' => 'Design and creative courses.',
                'image' => 'categories/design.jpg',
                'status' => true,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
