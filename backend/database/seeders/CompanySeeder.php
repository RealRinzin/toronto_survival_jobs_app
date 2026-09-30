<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('companies')->insert([
            [
                'name' => 'adidas',
                'slug' => 'adidas',
                'overview' =>"overview",
                'website' => 'https://www.adidas.ca',
                'logo' => 'logo.png',
                'business_category_id' => rand(1,10),
            ],
        ]);
    }
}
