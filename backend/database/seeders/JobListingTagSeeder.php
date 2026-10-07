<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobListingTagSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $pairs = [
            [1, 1], [1, 4], [1, 7],
            [2, 2], [2, 5],
            [3, 3], [3, 6], [3, 9],
            [4, 1], [4, 8],
            [5, 2], [5, 4], [5, 10],
            [6, 5], [6, 7],
            [7, 1], [7, 3], [7, 6],
            [8, 2], [8, 9],
            [9, 4], [9, 8], [9, 10],
            [10, 1], [10, 5],
            [11, 3], [11, 7], [11, 10],
            [12, 2], [12, 6],
            [13, 1], [13, 4], [13, 9],
            [14, 5], [14, 8],
            [15, 3], [15, 6], [15, 10],
            [16, 2], [16, 7],
            [17, 1], [17, 8], [17, 9],
            [18, 4], [18, 5],
            [19, 3], [19, 6], [19, 10],
            [20, 2], [20, 9],
        ];

        $rows = array_map(fn ($pair) => [
            'job_listing_id' => $pair[0],
            'tag_id'         => $pair[1],
            'created_at'     => $now,
            'updated_at'     => $now,
        ], $pairs);

        DB::table('job_listing_tag')->insert($rows);
    }
}