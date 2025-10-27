<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'John Doe',
                'job_title' => 'Senior Mathematics Teacher',
                'email' => 'john.doe@example.com',
                'phone' => '+91 98765 43210',
                'qualification' => 'M.Sc. Mathematics, B.Ed.',
                'specializations' => 'Mathematics, Physics',
                'bio' => 'With over 10 years of teaching experience, John specializes in making complex mathematical concepts easy to understand.',
                'social_links' => [
                    'facebook' => 'https://facebook.com/johndoe',
                    'linkedin' => 'https://linkedin.com/in/johndoe'
                ],
                'status' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Jane Smith',
                'job_title' => 'Science Coordinator',
                'email' => 'jane.smith@example.com',
                'phone' => '+91 98765 43211',
                'qualification' => 'M.Sc. Chemistry, Ph.D.',
                'specializations' => 'Chemistry, Biology',
                'bio' => 'Dr. Jane Smith brings practical laboratory experience and innovative teaching methods to make science engaging.',
                'social_links' => [
                    'linkedin' => 'https://linkedin.com/in/janesmith',
                    'twitter' => 'https://twitter.com/janesmith'
                ],
                'status' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Robert Wilson',
                'job_title' => 'Computer Science Instructor',
                'email' => 'robert.wilson@example.com',
                'phone' => '+91 98765 43212',
                'qualification' => 'M.Tech Computer Science',
                'specializations' => 'Programming, Web Development',
                'bio' => 'Robert is passionate about teaching coding and helping students develop their technical skills.',
                'social_links' => [
                    'github' => 'https://github.com/robertwilson',
                    'linkedin' => 'https://linkedin.com/in/robertwilson'
                ],
                'status' => true,
                'sort_order' => 3
            ]
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }
    }
}