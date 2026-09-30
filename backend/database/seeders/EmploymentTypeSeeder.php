<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmploymentTypeSeeder extends Seeder
{
    /**
     * Seed the employment_types table.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Full-Time',          'color_code' => '#2563eb'],
            ['name' => 'Part-Time',          'color_code' => '#0891b2'],
            ['name' => 'Temporary',          'color_code' => '#f59e0b'],
            // ['name' => 'Seasonal',           'color_code' => '#ea580c'],
            // ['name' => 'Casual',             'color_code' => '#65a30d'],
            // ['name' => 'On-Call',            'color_code' => '#dc2626'],
            // ['name' => 'Gig Work',           'color_code' => '#7c3aed'],
            ['name' => 'Contract',           'color_code' => '#0d9488'],
            // ['name' => 'Freelance',          'color_code' => '#db2777'],
            // ['name' => 'Day Labor',          'color_code' => '#78716c'],
            // ['name' => 'Agency Staffing',    'color_code' => '#4f46e5'],
            // ['name' => 'Shift-Based',        'color_code' => '#0284c7'],
            // ['name' => 'Commission-Based',   'color_code' => '#16a34a'],
            // ['name' => 'Zero-Hours',         'color_code' => '#be123c'],
            // ['name' => 'Weekend Only',       'color_code' => '#a16207'],
        ];

        $now = now();

        foreach ($types as $type) {
            $slug = Str::slug($type['name']);

            DB::table('employment_types')->updateOrInsert(
                ['slug' => $slug],
                [
                    'name'       => $type['name'],
                    'color_code' => $type['color_code'],
                    'active'     => false,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}