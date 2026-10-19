<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        // Existing IDs from related tables (empty table => null FK)
        $companyIds        = DB::table('companies')->pluck('id')->all();
        $employmentTypeIds = DB::table('employment_types')->pluck('id')->all();
        $categoryIds       = DB::table('job_categories')->pluck('id')->all();
        $areaIds           = DB::table('areas')->pluck('id')->all();
        $cityIds           = DB::table('cities')->pluck('id')->all();
        $provinceIds       = DB::table('provinces')->pluck('id')->all();

        $titles = [
            'Retail Sales Associate',
            'Customer Service Representative',
            'Supermarket Cashier',
            'Stock Clerk / Merchandiser',
            'Call Center Agent',
            'Starbucks Barista',
            'Restaurant Server',
            'Event Bartender',
            'Restaurant Line Cook',
            'Kitchen Dishwasher',
            'Warehouse Associate',
            'E-Commerce Delivery Driver',
            'Fulfillment Specialist',
            'Package Handler',
            'Rideshare Driver',
            'Data Entry Clerk',
            'Office Assistant',
            'Virtual Assistant',
            'Commercial Building Janitor',
            'Construction General Laborer',
        ];

        $now = now();
        $rows = [];

        foreach ($titles as $i => $title) {
            $postedDate = $now->copy()->subDays(rand(0, 20));
            $rows[] = [
                'title'       => $title,
                'slug'        => Str::slug($title) . '-' . ($i + 1) . random_int(1000, 9999),
                'unique_job_id'        => Str::slug($title) . '-' . ($i + 1),
                'description' => fake()->realText(100),
                'address'     => rand(100, 999) . ' King Street West',
                'location'    => 'Toronto, ON',
                'country'     => 'CA',
                'salary'      => rand(0, 1) ? rand(50000, 150000) : null,
                'published'   => $i < 8,   // 8 published, 2 drafts
                'apply_url'   => 'https://example.com/careers/' . Str::slug($title),
                'posted_date' => $postedDate->toDateString(),
                'due_date'    => $postedDate->copy()->addDays(rand(14, 45))->toDateString(),
                'system_posted_date' => $now->toDateString(),
                'created_at'  => $now,
                'updated_at'  => $now,
                'company_id'         => Arr::random($companyIds ?: [null]),
                'employment_type_id' => Arr::random($employmentTypeIds ?: [null]),
                'job_category_id'     => Arr::random($categoryIds ?: [null]),
                'area_id'            => Arr::random($areaIds ?: [null]),
                'city_id'            => Arr::random($cityIds ?: [null]),
                'province_id'        => Arr::random($provinceIds ?: [null]),
                'active'      => true,
            ];
        }

        DB::table('job_listings')->insert($rows);
    }
}
