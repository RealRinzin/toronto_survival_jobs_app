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
                'appliedFacets' => (object) [
                    "locationRegionStateProvince" => [
                        "218a720b28a74c67b5c6d42c00bdadfa"
                    ],
                    "locationHierarchy2" => [
                        // "4acf03b2e8e30167e22819530502f6dd",
                        "4acf03b2e8e3015b97f55d5305026ce0"
                    ],
                    "jobFamilyGroup" => [
                        "4acf03b2e8e3010f6c2451b60502b065"
                    ]
                ],
                'limit' => 20,
                'offset' => 0,
                'searchText' => '',
            ]),
            'origin' => 'https://bestbuycanada.wd3.myworkdayjobs.com',
            'referer' => 'https://bestbuycanada.wd3.myworkdayjobs.com',
            'endpoint' => 'https://bestbuycanada.wd3.myworkdayjobs.com/wday/cxs/bestbuycanada/BestBuyCA_Career/',
            'accept' => 'application/json',
            'accept_language' => 'en-US',
            'accept_encoding' => 'gzip,deflate,br,zstd',
            'content_type' => 'application/json',
            'user_agent' =>  'User Agent',
            'active' => true

        ]);
    }
}
