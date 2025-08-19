<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Offer::insert([
            [
                'title' => 'Summer Sale',
                'description' => 'Get 20% off on all courses.',
                'offer_code' => 'SUMMER20',
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'minimum_amount' => 50,
                'maximum_discount' => 30,
                'start_date' => now()->subDays(10),
                'end_date' => now()->addDays(20),
                'usage_limit' => 100,
                'used_count' => 0,
                'image' => 'offers/summer.jpg',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'New User Offer',
                'description' => 'Flat $10 off for new users.',
                'offer_code' => 'NEWUSER10',
                'discount_type' => 'fixed',
                'discount_value' => 10,
                'minimum_amount' => 0,
                'maximum_discount' => 10,
                'start_date' => now()->subDays(5),
                'end_date' => now()->addDays(25),
                'usage_limit' => 50,
                'used_count' => 0,
                'image' => 'offers/newuser.jpg',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
