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
        //
        $provinces = [
            [
                'name' => 'Alberta',
                'slug' => 'alberta',
                'overview' => 'A western Canadian province known for its Rocky Mountain scenery, energy industry, and cities like Calgary and Edmonton.',
            ],
            [
                'name' => 'British Columbia',
                'slug' => 'british-columbia',
                'overview' => 'A Pacific coast province famous for its rugged coastline, forests, and mountains, home to Vancouver and Victoria.',
            ],
            [
                'name' => 'Manitoba',
                'slug' => 'manitoba',
                'overview' => 'A central Canadian province known for its prairies, lakes, and vibrant capital, Winnipeg.',
            ],
            [
                'name' => 'New Brunswick',
                'slug' => 'new-brunswick',
                'overview' => 'An Atlantic province and Canada\'s only officially bilingual province, known for the Bay of Fundy tides.',
            ],
            [
                'name' => 'Newfoundland and Labrador',
                'slug' => 'newfoundland-and-labrador',
                'overview' => 'Canada\'s easternmost province, known for its rugged coastlines, icebergs, and unique maritime culture.',
            ],
            [
                'name' => 'Nova Scotia',
                'slug' => 'nova-scotia',
                'overview' => 'A Maritime province almost surrounded by the Atlantic Ocean, known for Halifax and its fishing heritage.',
            ],
            [
                'name' => 'Ontario',
                'slug' => 'ontario',
                'overview' => 'Canada\'s most populous province, home to the national capital Ottawa and the largest city, Toronto.',
            ],
            [
                'name' => 'Prince Edward Island',
                'slug' => 'prince-edward-island',
                'overview' => 'Canada\'s smallest province, known for its red sand beaches, farmland, and the novel Anne of Green Gables.',
            ],
            [
                'name' => 'Quebec',
                'slug' => 'quebec',
                'overview' => 'Canada\'s largest province by area and its French-speaking heartland, home to Montreal and Quebec City.',
            ],
            [
                'name' => 'Saskatchewan',
                'slug' => 'saskatchewan',
                'overview' => 'A prairie province known for its vast farmland, grain production, and open skies.',
            ],
            [
                'name' => 'Northwest Territories',
                'slug' => 'northwest-territories',
                'overview' => 'A northern territory known for its vast wilderness, diamond mining, and the Arctic city of Yellowknife.',
            ],
            [
                'name' => 'Nunavut',
                'slug' => 'nunavut',
                'overview' => 'Canada\'s newest and largest territory, home to a majority Inuit population and vast Arctic landscapes.',
            ],
            [
                'name' => 'Yukon',
                'slug' => 'yukon',
                'overview' => 'A northern territory known for the Klondike Gold Rush history and dramatic mountain wilderness.',
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
