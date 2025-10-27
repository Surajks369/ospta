<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            CourseSeeder::class,
            GallerySeeder::class,
            FaqSeeder::class,
            UserRegistrationSeeder::class,
            TestimonialSeeder::class,
            OfferSeeder::class,
            DemoBookingSeeder::class,
            CourseEnrollmentSeeder::class,
            TeamMemberSeeder::class,
        ]);
    }
}
