<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            // Work arrangement
            // 'Full-time',
            // 'Part-time',
            // 'Temporary',
            // 'Contract',
            // 'Seasonal',
            // 'Casual',
            // 'Internship',
            // 'Remote',
            // 'Hybrid',
            // 'On-site',

            // Schedule
            'Weekends',
            'Evenings',
            'Overnight',
            'Flexible Hours',
            'Shift Work',

            // Entry-level friendly
            'No Experience Required',
            'Entry Level',
            'Student Friendly',
            'Newcomer Friendly',
            'On-the-job Training',
            'Immediate Start',

            // // Industries
            // 'Retail',
            // 'Warehouse',
            // 'Food Service',
            // 'Restaurant',
            // 'Cafe',
            // 'Hospitality',
            // 'Customer Service',
            // 'Delivery',
            // 'Driver',
            // 'Construction',
            // 'Cleaning',
            // 'Security',
            // 'Healthcare Support',
            // 'Personal Support Worker',
            // 'Childcare',
            // 'Call Centre',
            // 'Administration',
            // 'Manufacturing',
            // 'Landscaping',
            // 'Moving',

            // // Roles
            // 'Cashier',
            // 'Server',
            // 'Barista',
            // 'Cook',
            // 'Dishwasher',
            // 'Stock Clerk',
            // 'Forklift Operator',
            // 'Janitor',
            // 'Labourer',
            // 'Sales Associate',
            // 'Receptionist',
            // 'Data Entry',

            // Perks / requirements
            'Tips',
            'Benefits',
            'Cash Pay',
            'Transit Accessible',
            'Driver\'s Licence Required',
            'Own Vehicle Required',
            'Bilingual',
            'French',
            'Police Check Required',
        ];

        foreach ($tags as $name) {
            Tag::firstOrCreate(
                [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description'=> fake()->name(),
                    'tagline'=> fake()->word(),
                ],
            );
        }
    }
}
