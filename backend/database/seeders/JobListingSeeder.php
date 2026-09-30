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
            'Senior Laravel Developer',
            'React Frontend Engineer',
            'Full Stack Developer',
            'Next.js Developer',
            'Backend PHP Engineer',
            'DevOps Engineer',
            'QA Automation Analyst',
            'Product Designer',
            'Data Analyst',
            'Software Engineering Intern',
        ];

        $now = now();
        $rows = [];

        foreach ($titles as $i => $title) {
            $postedDate = $now->copy()->subDays(rand(0, 20));

            $rows[] = [
                'title'       => $title,
                'slug'        => Str::slug($title) . '-' . ($i + 1),
                'description' => "We are looking for a {$title} to join our team. "
                    . "You will collaborate with cross-functional teams, write clean and "
                    . "maintainable code, and help ship features to production.",
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
                'job_category_d'     => Arr::random($categoryIds ?: [null]),
                'area_id'            => Arr::random($areaIds ?: [null]),
                'city_id'            => Arr::random($cityIds ?: [null]),
                'province_id'        => Arr::random($provinceIds ?: [null]),

                'active'      => true,
            ];
        }

        DB::table('job_listings')->insert($rows);
    }
}