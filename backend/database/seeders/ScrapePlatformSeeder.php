<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScrapePlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //
        DB::table('scrape_platforms')->insert([
            [
                'name' => 'MyWorkDay',
                'slug' => 'myworkday',
                'scrape_method' => 'api'
            ],
        ]);
    }
}
