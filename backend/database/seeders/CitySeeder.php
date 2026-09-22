<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $citiesByProvince = [
            'alberta' => [
                ['name' => 'Calgary', 'slug' => 'calgary', 'overview' => 'A major city known for the Calgary Stampede, its energy sector headquarters, and proximity to the Rocky Mountains.', 'latitude' => 51.0447, 'longitude' => -114.0719],
                ['name' => 'Edmonton', 'slug' => 'edmonton', 'overview' => 'The provincial capital, known for the West Edmonton Mall and its river valley parks system.', 'latitude' => 53.5461, 'longitude' => -113.4938],
                ['name' => 'Red Deer', 'slug' => 'red-deer', 'overview' => 'A central Alberta city situated between Calgary and Edmonton.', 'latitude' => 52.2681, 'longitude' => -113.8112],
            ],
            'british-columbia' => [
                ['name' => 'Vancouver', 'slug' => 'vancouver', 'overview' => 'A major Pacific coast city known for its mountains, harbour, and diverse population.', 'latitude' => 49.2827, 'longitude' => -123.1207],
                ['name' => 'Victoria', 'slug' => 'victoria', 'overview' => 'The provincial capital, located on Vancouver Island and known for its British colonial architecture.', 'latitude' => 48.4284, 'longitude' => -123.3656],
                ['name' => 'Kelowna', 'slug' => 'kelowna', 'overview' => 'A city in the Okanagan Valley known for wineries and lakes.', 'latitude' => 49.8880, 'longitude' => -119.4960],
            ],
            'manitoba' => [
                ['name' => 'Winnipeg', 'slug' => 'winnipeg', 'overview' => 'The provincial capital and largest city, known for its arts scene and as a rail and transport hub.', 'latitude' => 49.8951, 'longitude' => -97.1384],
                ['name' => 'Brandon', 'slug' => 'brandon', 'overview' => 'The second-largest city in Manitoba, serving as an agricultural hub.', 'latitude' => 49.8483, 'longitude' => -99.9501],
            ],
            'new-brunswick' => [
                ['name' => 'Fredericton', 'slug' => 'fredericton', 'overview' => 'The provincial capital, known for its historic downtown and universities.', 'latitude' => 45.9636, 'longitude' => -66.6431],
                ['name' => 'Saint John', 'slug' => 'saint-john', 'overview' => 'The oldest incorporated city in Canada, known for its port and the Bay of Fundy.', 'latitude' => 45.2733, 'longitude' => -66.0633],
                ['name' => 'Moncton', 'slug' => 'moncton', 'overview' => 'A bilingual city known as a commercial and transportation hub for the Maritimes.', 'latitude' => 46.0878, 'longitude' => -64.7782],
            ],
            'newfoundland-and-labrador' => [
                ['name' => "St. John's", 'slug' => 'st-johns', 'overview' => 'The provincial capital and one of the oldest cities in North America, known for its colourful row houses.', 'latitude' => 47.5615, 'longitude' => -52.7126],
                ['name' => 'Corner Brook', 'slug' => 'corner-brook', 'overview' => 'The second-largest city, located on the west coast near Gros Morne National Park.', 'latitude' => 48.9500, 'longitude' => -57.9522],
            ],
            'nova-scotia' => [
                ['name' => 'Halifax', 'slug' => 'halifax', 'overview' => 'The provincial capital and largest city in Atlantic Canada, known for its historic waterfront and naval heritage.', 'latitude' => 44.6488, 'longitude' => -63.5752],
                ['name' => 'Sydney', 'slug' => 'sydney', 'overview' => 'A city on Cape Breton Island known for its coal and steel history.', 'latitude' => 46.1368, 'longitude' => -60.1942],
            ],
            'ontario' => [
                ['name' => 'Toronto', 'slug' => 'toronto', 'overview' => "Canada's largest city and financial capital, known for the CN Tower and its multicultural neighbourhoods.", 'latitude' => 43.6532, 'longitude' => -79.3832],
                ['name' => 'Ottawa', 'slug' => 'ottawa', 'overview' => "Canada's national capital, home to Parliament Hill and federal government institutions.", 'latitude' => 45.4215, 'longitude' => -75.6972],
                ['name' => 'Hamilton', 'slug' => 'hamilton', 'overview' => 'An industrial city known for steel production and its waterfalls.', 'latitude' => 43.2557, 'longitude' => -79.8711],
                ['name' => 'London', 'slug' => 'london', 'overview' => 'A city in southwestern Ontario known for its universities and green spaces.', 'latitude' => 42.9849, 'longitude' => -81.2453],
            ],
            'prince-edward-island' => [
                ['name' => 'Charlottetown', 'slug' => 'charlottetown', 'overview' => 'The provincial capital, known as the birthplace of Canadian Confederation.', 'latitude' => 46.2382, 'longitude' => -63.1311],
                ['name' => 'Summerside', 'slug' => 'summerside', 'overview' => "PEI's second-largest city, known for its waterfront and lobster industry.", 'latitude' => 46.3959, 'longitude' => -63.7876],
            ],
            'quebec' => [
                ['name' => 'Montreal', 'slug' => 'montreal', 'overview' => "Quebec's largest city, known for its French heritage, festivals, and old town.", 'latitude' => 45.5019, 'longitude' => -73.5674],
                ['name' => 'Quebec City', 'slug' => 'quebec-city', 'overview' => 'The provincial capital, known for its walled Old Town and Château Frontenac.', 'latitude' => 46.8139, 'longitude' => -71.2080],
                ['name' => 'Gatineau', 'slug' => 'gatineau', 'overview' => 'A city across the river from Ottawa, part of the National Capital Region.', 'latitude' => 45.4765, 'longitude' => -75.7013],
            ],
            'saskatchewan' => [
                ['name' => 'Saskatoon', 'slug' => 'saskatoon', 'overview' => 'The largest city in Saskatchewan, known as the "Paris of the Prairies" for its bridges and river valley.', 'latitude' => 52.1332, 'longitude' => -106.6700],
                ['name' => 'Regina', 'slug' => 'regina', 'overview' => 'The provincial capital, home to the RCMP Training Academy.', 'latitude' => 50.4452, 'longitude' => -104.6189],
            ],
            'northwest-territories' => [
                ['name' => 'Yellowknife', 'slug' => 'yellowknife', 'overview' => 'The territorial capital, known for diamond mining and views of the Northern Lights.', 'latitude' => 62.4540, 'longitude' => -114.3718],
            ],
            'nunavut' => [
                ['name' => 'Iqaluit', 'slug' => 'iqaluit', 'overview' => 'The territorial capital, located on Baffin Island with a majority Inuit population.', 'latitude' => 63.7467, 'longitude' => -68.5170],
            ],
            'yukon' => [
                ['name' => 'Whitehorse', 'slug' => 'whitehorse', 'overview' => 'The territorial capital, known as a gateway to the Yukon wilderness and Klondike history.', 'latitude' => 60.7212, 'longitude' => -135.0568],
            ],
        ];

        foreach ($citiesByProvince as $provinceSlug => $cities) {
            $provinceId = DB::table('provinces')->where('slug', $provinceSlug)->value('id');

            if (! $provinceId) {
                continue;
            }

            foreach ($cities as $city) {
                DB::table('cities')->insert(array_merge($city, [
                    'province_id' => $provinceId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }
}
