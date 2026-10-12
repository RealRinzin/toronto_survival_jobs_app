<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScrapCompanyJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('scrape_company_jobs')->insert([
            'company_id' => 1,
            'scrape_platform_id' => 1,
            'base_url' => 'https://bestbuycanada.wd3.myworkdayjobs.com/wday/cxs/bestbuycanada/BestBuyCA_Career/jobs',
            'method' => 'POST',
            'response_type' => 'json',
            'request_body' => json_encode([
                'appliedFacets' => (object) [],
                'limit' => 20,
                'offset' => 0,
                'searchText' => '',
            ]),
            'origin' => 'https://bestbuycanada.wd3.myworkdayjobs.com',
            'referer' => 'https://bestbuycanada.wd3.myworkdayjobs.com',
            'accept' => 'application/json',
            'accept_language' => 'en-US',
            'accept_encoding' => 'gzip,deflate,br,zstd',
            'content_type' => 'application/json',
            'user_agent' =>  'Mo',
            'active' => true

        ]);
    }
}
