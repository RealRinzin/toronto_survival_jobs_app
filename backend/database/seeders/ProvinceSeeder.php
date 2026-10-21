<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProvinceSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            [
                'name' => 'Alberta',
                'slug' => 'alberta',
                'short_code'=>'AB',
                'overview' => 'A western Canadian province known for its Rocky Mountain scenery, energy industry, and cities like Calgary and Edmonton.',
                'latitude' => 53.9333,
                'longitude' => -116.5765,
            ],
            [
                'name' => 'British Columbia',
                'slug' => 'british-columbia',
                'short_code'=>'BC',
                'overview' => 'A Pacific coast province famous for its rugged coastline, forests, and mountains, home to Vancouver and Victoria.',
                'latitude' => 53.7267,
                'longitude' => -127.6476,
            ],
            [
                'name' => 'Manitoba',
                'slug' => 'manitoba',
                'short_code'=> 'MB',
                'overview' => 'A central Canadian province known for its prairies, lakes, and vibrant capital, Winnipeg.',
                'latitude' => 53.7609,
                'longitude' => -98.8139,
            ],
            [
                'name' => 'New Brunswick',
                'slug' => 'new-brunswick',
                'short_code'=> 'NB',
                'overview' => 'An Atlantic province and Canada\'s only officially bilingual province, known for the Bay of Fundy tides.',
                'latitude' => 46.5653,
                'longitude' => -66.4619,
            ],
            [
                'name' => 'Newfoundland and Labrador',
                'slug' => 'newfoundland-and-labrador',
                'short_code'=>'NL',
                'overview' => 'Canada\'s easternmost province, known for its rugged coastlines, icebergs, and unique maritime culture.',
                'latitude' => 53.1355,
                'longitude' => -57.6604,
            ],
            [
                'name' => 'Nova Scotia',
                'slug' => 'nova-scotia',
                'short_code'=>'NS',
                'overview' => 'A Maritime province almost surrounded by the Atlantic Ocean, known for Halifax and its fishing heritage.',
                'latitude' => 44.6820,
                'longitude' => -63.7443,
            ],
            [
                'name' => 'Ontario',
                'slug' => 'ontario',
                'short_code'=>'ON',
                'overview' => 'Canada\'s most populous province, home to the national capital Ottawa and the largest city, Toronto.',
                'latitude' => 51.2538,
                'longitude' => -85.3232,
            ],
            [
                'name' => 'Prince Edward Island',
                'slug' => 'prince-edward-island',
                'short_code'=>'PE',
                'overview' => 'Canada\'s smallest province, known for its red sand beaches, farmland, and the novel Anne of Green Gables.',
                'latitude' => 46.5107,
                'longitude' => -63.4168,
            ],
            [
                'name' => 'Quebec',
                'slug' => 'quebec',
                'short_code'=>'QC',
                'overview' => 'Canada\'s largest province by area and its French-speaking heartland, home to Montreal and Quebec City.',
                'latitude' => 52.9399,
                'longitude' => -73.5491,
            ],
            [
                'name' => 'Saskatchewan',
                'slug' => 'saskatchewan',
                'short_code'=> 'SK',
                'overview' => 'A prairie province known for its vast farmland, grain production, and open skies.',
                'latitude' => 52.9399,
                'longitude' => -106.4509,
            ],
            [
                'name' => 'Northwest Territories',
                'slug' => 'northwest-territories',
                'short_code'=> 'NT',
                'overview' => 'A northern territory known for its vast wilderness, diamond mining, and the Arctic city of Yellowknife.',
                'latitude' => 64.8255,
                'longitude' => -124.8457,
            ],
            [
                'name' => 'Nunavut',
                'slug' => 'nunavut',
                'short_code'=> 'NU',
                'overview' => 'Canada\'s newest and largest territory, home to a majority Inuit population and vast Arctic landscapes.',
                'latitude' => 70.2998,
                'longitude' => -83.1076,
            ],
            [
                'name' => 'Yukon',
                'slug' => 'yukon',
                'short_code'=> 'YT',
                'overview' => 'A northern territory known for the Klondike Gold Rush history and dramatic mountain wilderness.',
                'latitude' => 64.2823,
                'longitude' => -135.0000,
            ],
        ];

        foreach ($provinces as $province) {
            DB::table('provinces')->insert(array_merge($province, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
