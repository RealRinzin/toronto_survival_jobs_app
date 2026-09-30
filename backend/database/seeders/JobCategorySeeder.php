<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
$categories = [
            ['name' => 'Sales Associate',          'color_code' => '#2563eb'],
            ['name' => 'Cashier',                  'color_code' => '#0891b2'],
            ['name' => 'Warehouse Associate',      'color_code' => '#f59e0b'],
            ['name' => 'Delivery Driver',          'color_code' => '#ea580c'],
            ['name' => 'Rideshare Driver',         'color_code' => '#7c3aed'],
            ['name' => 'Server / Waitstaff',       'color_code' => '#dc2626'],
            ['name' => 'Line Cook / Dishwasher',   'color_code' => '#b45309'],
            ['name' => 'Barista',                  'color_code' => '#78350f'],
            ['name' => 'Janitor / Cleaner',        'color_code' => '#0d9488'],
            ['name' => 'Security Guard',           'color_code' => '#1e293b'],
            ['name' => 'Call Center Agent',        'color_code' => '#4f46e5'],
            ['name' => 'Data Entry Clerk',         'color_code' => '#0284c7'],
            ['name' => 'Home Health Aide',         'color_code' => '#db2777'],
            ['name' => 'Construction Laborer',     'color_code' => '#a16207'],
            ['name' => 'Farm Worker',              'color_code' => '#65a30d'],
        ];

        $now = now();

        foreach ($categories as $category) {
            $slug = Str::slug($category['name']);

            DB::table('job_categories')->updateOrInsert(
                ['slug' => $slug],
                [
                    'name'       => $category['name'],
                    'color_code' => $category['color_code'],
                    'active'     => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    
    }
}
