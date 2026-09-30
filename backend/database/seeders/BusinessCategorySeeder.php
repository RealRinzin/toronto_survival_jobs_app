<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use Illuminate\Database\Seeder;

class BusinessCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Retail',
                'slug' => 'retail',
                'color_code' => '#3B82F6',
            ],
            [
                'name' => 'Grocery & Supermarkets',
                'slug' => 'grocery-supermarkets',
                'color_code' => '#10B981',
            ],
            [
                'name' => 'Restaurants & Food Service',
                'slug' => 'restaurants-food-service',
                'color_code' => '#F59E0B',
            ],
            [
                'name' => 'Warehousing & Distribution',
                'slug' => 'warehousing-distribution',
                'color_code' => '#6366F1',
            ],
            [
                'name' => 'Hospitality & Hotels',
                'slug' => 'hospitality-hotels',
                'color_code' => '#8B5CF6',
            ],
            [
                'name' => 'Cleaning & Janitorial',
                'slug' => 'cleaning-janitorial',
                'color_code' => '#06B6D4',
            ],
            [
                'name' => 'Security',
                'slug' => 'security',
                'color_code' => '#64748B',
            ],
            [
                'name' => 'Customer Service & Call Centres',
                'slug' => 'customer-service-call-centres',
                'color_code' => '#EC4899',
            ],
            [
                'name' => 'Delivery & Courier',
                'slug' => 'delivery-courier',
                'color_code' => '#EF4444',
            ],
            [
                'name' => 'General Labour',
                'slug' => 'general-labour',
                'color_code' => '#D97706',
            ],
        ];

        foreach ($categories as $category) {
            BusinessCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}