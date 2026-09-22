<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Assumes ProvinceSeeder and CitySeeder have already run.
     * Areas are keyed by city slug. Each area references its city via city_id.
     * Downtown Toronto has nested sub-areas (parent_id) as an example of the
     * self-referencing structure — feel free to nest other cities the same way.
     */
    public function run(): void
    {
        $areasByCity = [
            // ---------------- ALBERTA ----------------
            'calgary' => [
                ['name' => 'Downtown Calgary', 'slug' => 'downtown-calgary', 'overview' => "Calgary's central business district, home to the Stephen Avenue pedestrian mall and major office towers.", 'latitude' => 51.0486, 'longitude' => -114.0708],
                ['name' => 'Beltline', 'slug' => 'beltline', 'overview' => 'A dense, walkable neighbourhood south of downtown known for nightlife and high-rise condos.', 'latitude' => 51.0400, 'longitude' => -114.0765],
                ['name' => 'Kensington', 'slug' => 'kensington-calgary', 'overview' => 'A trendy shopping and dining strip across the river from downtown.', 'latitude' => 51.0526, 'longitude' => -114.0917],
                ['name' => 'Inglewood', 'slug' => 'inglewood-calgary', 'overview' => "Calgary's oldest neighbourhood, known for antique shops and live music venues.", 'latitude' => 51.0374, 'longitude' => -114.0369],
            ],
            'edmonton' => [
                ['name' => 'Downtown Edmonton', 'slug' => 'downtown-edmonton', 'overview' => "Edmonton's civic and business core, home to government buildings and the arts district.", 'latitude' => 53.5444, 'longitude' => -113.4909],
                ['name' => 'Old Strathcona', 'slug' => 'old-strathcona', 'overview' => 'A historic district south of the river known as Whyte Avenue, popular for shopping and nightlife.', 'latitude' => 53.5190, 'longitude' => -113.4990],
                ['name' => 'Oliver', 'slug' => 'oliver-edmonton', 'overview' => 'A dense residential neighbourhood just west of downtown along the river valley.', 'latitude' => 53.5461, 'longitude' => -113.5225],
                ['name' => 'Mill Woods', 'slug' => 'mill-woods', 'overview' => 'A large, diverse residential community in southeast Edmonton.', 'latitude' => 53.4650, 'longitude' => -113.4550],
            ],
            'red-deer' => [
                ['name' => 'Downtown Red Deer', 'slug' => 'downtown-red-deer', 'overview' => "Red Deer's central commercial core along Gaetz Avenue.", 'latitude' => 52.2690, 'longitude' => -113.8116],
                ['name' => 'Riverside Meadows', 'slug' => 'riverside-meadows', 'overview' => 'A residential neighbourhood along the Red Deer River.', 'latitude' => 52.2830, 'longitude' => -113.7930],
            ],

            // ---------------- BRITISH COLUMBIA ----------------
            'vancouver' => [
                ['name' => 'Downtown Vancouver', 'slug' => 'downtown-vancouver', 'overview' => "Vancouver's business and cultural core, bordered by the waterfront and Stanley Park.", 'latitude' => 49.2827, 'longitude' => -123.1207],
                ['name' => 'Kitsilano', 'slug' => 'kitsilano', 'overview' => 'A beachside neighbourhood known for its laid-back, outdoorsy lifestyle.', 'latitude' => 49.2669, 'longitude' => -123.1554],
                ['name' => 'Yaletown', 'slug' => 'yaletown', 'overview' => 'A former warehouse district turned upscale residential and dining area.', 'latitude' => 49.2751, 'longitude' => -123.1216],
                ['name' => 'Mount Pleasant', 'slug' => 'mount-pleasant-vancouver', 'overview' => 'A creative, industrial-turned-trendy neighbourhood known for breweries and studios.', 'latitude' => 49.2636, 'longitude' => -123.1004],
            ],
            'victoria' => [
                ['name' => 'Downtown Victoria', 'slug' => 'downtown-victoria', 'overview' => 'The historic core of Victoria, home to the Inner Harbour and BC Legislature.', 'latitude' => 48.4262, 'longitude' => -123.3661],
                ['name' => 'Oak Bay', 'slug' => 'oak-bay', 'overview' => 'An upscale seaside municipality known for its British character.', 'latitude' => 48.4300, 'longitude' => -123.3100],
                ['name' => 'Fairfield', 'slug' => 'fairfield-victoria', 'overview' => 'A residential neighbourhood near Beacon Hill Park.', 'latitude' => 48.4130, 'longitude' => -123.3400],
            ],
            'kelowna' => [
                ['name' => 'Downtown Kelowna', 'slug' => 'downtown-kelowna', 'overview' => "Kelowna's waterfront core along Okanagan Lake, known for its cultural district.", 'latitude' => 49.8864, 'longitude' => -119.4966],
                ['name' => 'Glenmore', 'slug' => 'glenmore', 'overview' => 'A residential valley neighbourhood north of downtown Kelowna.', 'latitude' => 49.9100, 'longitude' => -119.4600],
            ],

            // ---------------- MANITOBA ----------------
            'winnipeg' => [
                ['name' => 'Downtown Winnipeg', 'slug' => 'downtown-winnipeg', 'overview' => "Winnipeg's central business district, home to the historic Exchange District.", 'latitude' => 49.8955, 'longitude' => -97.1384],
                ['name' => 'Exchange District', 'slug' => 'exchange-district', 'overview' => 'A National Historic Site known for its early 20th-century architecture and arts scene.', 'latitude' => 49.9019, 'longitude' => -97.1414],
                ['name' => 'St. Boniface', 'slug' => 'st-boniface', 'overview' => "Winnipeg's French quarter, with a distinct cultural and historic identity.", 'latitude' => 49.8890, 'longitude' => -97.1210],
                ['name' => 'Osborne Village', 'slug' => 'osborne-village', 'overview' => 'A dense, eclectic neighbourhood known for shops, cafes, and nightlife.', 'latitude' => 49.8760, 'longitude' => -97.1450],
            ],
            'brandon' => [
                ['name' => 'Downtown Brandon', 'slug' => 'downtown-brandon', 'overview' => "Brandon's central commercial core along Rosser Avenue.", 'latitude' => 49.8478, 'longitude' => -99.9531],
            ],

            // ---------------- NEW BRUNSWICK ----------------
            'fredericton' => [
                ['name' => 'Downtown Fredericton', 'slug' => 'downtown-fredericton', 'overview' => "Fredericton's historic core along the Saint John River, home to the legislature.", 'latitude' => 45.9636, 'longitude' => -66.6431],
            ],
            'saint-john' => [
                ['name' => 'Uptown Saint John', 'slug' => 'uptown-saint-john', 'overview' => "Saint John's historic core, known as the city's cultural and business hub.", 'latitude' => 45.2718, 'longitude' => -66.0633],
            ],
            'moncton' => [
                ['name' => 'Downtown Moncton', 'slug' => 'downtown-moncton', 'overview' => "Moncton's central commercial district along Main Street.", 'latitude' => 46.0878, 'longitude' => -64.7782],
            ],

            // ---------------- NEWFOUNDLAND AND LABRADOR ----------------
            'st-johns' => [
                ['name' => 'Downtown St. John\'s', 'slug' => 'downtown-st-johns', 'overview' => "St. John's historic waterfront core, known for its colourful row houses along Water Street.", 'latitude' => 47.5615, 'longitude' => -52.7126],
            ],
            'corner-brook' => [
                ['name' => 'Downtown Corner Brook', 'slug' => 'downtown-corner-brook', 'overview' => "Corner Brook's central commercial area near the Bay of Islands.", 'latitude' => 48.9500, 'longitude' => -57.9522],
            ],

            // ---------------- NOVA SCOTIA ----------------
            'halifax' => [
                ['name' => 'Downtown Halifax', 'slug' => 'downtown-halifax', 'overview' => "Halifax's historic waterfront core, home to the Citadel and harbourfront boardwalk.", 'latitude' => 44.6476, 'longitude' => -63.5728],
                ['name' => 'North End Halifax', 'slug' => 'north-end-halifax', 'overview' => 'A revitalized, artsy neighbourhood known for its diverse food scene.', 'latitude' => 44.6580, 'longitude' => -63.5960],
                ['name' => 'South End Halifax', 'slug' => 'south-end-halifax', 'overview' => 'A leafy residential area home to Dalhousie University and Point Pleasant Park.', 'latitude' => 44.6300, 'longitude' => -63.5850],
            ],
            'sydney' => [
                ['name' => 'Downtown Sydney', 'slug' => 'downtown-sydney', 'overview' => "Sydney's central core on Cape Breton Island.", 'latitude' => 46.1368, 'longitude' => -60.1942],
            ],

            // ---------------- ONTARIO ----------------
            'toronto' => [
                ['name' => 'Downtown Toronto', 'slug' => 'downtown-toronto', 'overview' => 'The historic core of Toronto, home to the Financial District, entertainment venues, and the CN Tower.', 'latitude' => 43.6547, 'longitude' => -79.3810],
                ['name' => 'Etobicoke', 'slug' => 'etobicoke', 'overview' => 'A western district known for its parks, waterfront trails, and suburban residential communities.', 'latitude' => 43.6205, 'longitude' => -79.5132],
                ['name' => 'North York', 'slug' => 'north-york', 'overview' => 'A north-central district with a mix of business hubs like North York Centre and residential neighbourhoods.', 'latitude' => 43.7615, 'longitude' => -79.4111],
                ['name' => 'Scarborough', 'slug' => 'scarborough', 'overview' => 'A large eastern district known for its diverse communities and the Scarborough Bluffs.', 'latitude' => 43.7764, 'longitude' => -79.2318],
                ['name' => 'York', 'slug' => 'york', 'overview' => 'A smaller central-west district with historic residential neighbourhoods.', 'latitude' => 43.6896, 'longitude' => -79.4534],
                ['name' => 'East York', 'slug' => 'east-york', 'overview' => 'A compact central-east district known for its family-friendly residential streets.', 'latitude' => 43.6913, 'longitude' => -79.3266],
                ['name' => 'Financial District', 'slug' => 'financial-district', 'overview' => "Toronto's business core, home to major bank towers and the Toronto Stock Exchange.", 'latitude' => 43.6483, 'longitude' => -79.3808, 'parent_slug' => 'downtown-toronto'],
                ['name' => 'Entertainment District', 'slug' => 'entertainment-district', 'overview' => 'A hub for theatres, nightlife, and event venues, including the Rogers Centre area.', 'latitude' => 43.6453, 'longitude' => -79.3915, 'parent_slug' => 'downtown-toronto'],
                ['name' => 'Distillery District', 'slug' => 'distillery-district', 'overview' => 'A pedestrian-only historic district known for Victorian-era industrial architecture, shops, and galleries.', 'latitude' => 43.6503, 'longitude' => -79.3592, 'parent_slug' => 'downtown-toronto'],
                ['name' => 'Yorkville', 'slug' => 'yorkville', 'overview' => 'An upscale shopping and dining neighbourhood known for boutiques and cultural venues.', 'latitude' => 43.6709, 'longitude' => -79.3933, 'parent_slug' => 'downtown-toronto'],
            ],
            'ottawa' => [
                ['name' => 'Downtown Ottawa', 'slug' => 'downtown-ottawa', 'overview' => "Ottawa's central core, home to Parliament Hill and federal government buildings.", 'latitude' => 45.4215, 'longitude' => -75.6972],
                ['name' => 'ByWard Market', 'slug' => 'byward-market', 'overview' => 'A historic market district known for shops, restaurants, and nightlife.', 'latitude' => 45.4285, 'longitude' => -75.6920],
                ['name' => 'Centretown', 'slug' => 'centretown', 'overview' => "Ottawa's densest residential neighbourhood, just south of Parliament Hill.", 'latitude' => 45.4140, 'longitude' => -75.6930],
                ['name' => 'Kanata', 'slug' => 'kanata', 'overview' => "A western suburb known as Ottawa's tech hub.", 'latitude' => 45.3088, 'longitude' => -75.9200],
            ],
            'hamilton' => [
                ['name' => 'Downtown Hamilton', 'slug' => 'downtown-hamilton', 'overview' => "Hamilton's central business and arts district.", 'latitude' => 43.2560, 'longitude' => -79.8690],
                ['name' => 'Westdale', 'slug' => 'westdale', 'overview' => 'A neighbourhood near McMaster University known for its walkable village feel.', 'latitude' => 43.2650, 'longitude' => -79.9180],
            ],
            'london' => [
                ['name' => 'Downtown London', 'slug' => 'downtown-london', 'overview' => "London's central core along the Thames River, home to Budweiser Gardens.", 'latitude' => 42.9849, 'longitude' => -81.2453],
                ['name' => 'Old East Village', 'slug' => 'old-east-village', 'overview' => 'A revitalizing arts-focused neighbourhood east of downtown.', 'latitude' => 42.9870, 'longitude' => -81.2280],
            ],

            // ---------------- PRINCE EDWARD ISLAND ----------------
            'charlottetown' => [
                ['name' => 'Downtown Charlottetown', 'slug' => 'downtown-charlottetown', 'overview' => "Charlottetown's historic waterfront core, birthplace of Confederation.", 'latitude' => 46.2382, 'longitude' => -63.1311],
            ],
            'summerside' => [
                ['name' => 'Downtown Summerside', 'slug' => 'downtown-summerside', 'overview' => "Summerside's waterfront commercial core.", 'latitude' => 46.3959, 'longitude' => -63.7876],
            ],

            // ---------------- QUEBEC ----------------
            'montreal' => [
                ['name' => 'Downtown Montreal', 'slug' => 'downtown-montreal', 'overview' => "Montreal's central business and shopping district.", 'latitude' => 45.5017, 'longitude' => -73.5673],
                ['name' => 'Plateau-Mont-Royal', 'slug' => 'plateau-mont-royal', 'overview' => 'A bohemian neighbourhood known for colourful row houses and cafes.', 'latitude' => 45.5234, 'longitude' => -73.5800],
                ['name' => 'Old Montreal', 'slug' => 'old-montreal', 'overview' => 'A cobblestoned historic district along the waterfront with 17th and 18th-century architecture.', 'latitude' => 45.5075, 'longitude' => -73.5540],
            ],
            'quebec-city' => [
                ['name' => 'Old Quebec', 'slug' => 'old-quebec', 'overview' => 'A UNESCO World Heritage walled city, home to the Château Frontenac.', 'latitude' => 46.8127, 'longitude' => -71.2033],
                ['name' => 'Sainte-Foy', 'slug' => 'sainte-foy', 'overview' => "A residential and commercial district in western Quebec City, home to Université Laval.", 'latitude' => 46.7770, 'longitude' => -71.2950],
            ],
            'gatineau' => [
                ['name' => 'Hull', 'slug' => 'hull-gatineau', 'overview' => "Gatineau's historic core, directly across the river from downtown Ottawa.", 'latitude' => 45.4285, 'longitude' => -75.7150],
            ],

            // ---------------- SASKATCHEWAN ----------------
            'saskatoon' => [
                ['name' => 'Downtown Saskatoon', 'slug' => 'downtown-saskatoon', 'overview' => "Saskatoon's central business core along the South Saskatchewan River.", 'latitude' => 52.1315, 'longitude' => -106.6700],
                ['name' => 'Nutana', 'slug' => 'nutana', 'overview' => 'A historic neighbourhood known as Saskatoon\'s Broadway Avenue arts district.', 'latitude' => 52.1180, 'longitude' => -106.6590],
            ],
            'regina' => [
                ['name' => 'Downtown Regina', 'slug' => 'downtown-regina', 'overview' => "Regina's central business core.", 'latitude' => 50.4501, 'longitude' => -104.6178],
                ['name' => 'Cathedral', 'slug' => 'cathedral-regina', 'overview' => "One of Regina's oldest and most eclectic neighbourhoods.", 'latitude' => 50.4460, 'longitude' => -104.6350],
            ],

            // ---------------- NORTHWEST TERRITORIES ----------------
            'yellowknife' => [
                ['name' => 'Downtown Yellowknife', 'slug' => 'downtown-yellowknife', 'overview' => "Yellowknife's modern commercial core.", 'latitude' => 62.4540, 'longitude' => -114.3718],
                ['name' => 'Old Town', 'slug' => 'old-town-yellowknife', 'overview' => 'The original settlement area on a rocky peninsula, known for houseboats and float planes.', 'latitude' => 62.4610, 'longitude' => -114.3540],
            ],

            // ---------------- NUNAVUT ----------------
            'iqaluit' => [
                ['name' => 'Downtown Iqaluit', 'slug' => 'downtown-iqaluit', 'overview' => "Iqaluit's central area near the waterfront on Frobisher Bay.", 'latitude' => 63.7467, 'longitude' => -68.5170],
            ],

            // ---------------- YUKON ----------------
            'whitehorse' => [
                ['name' => 'Downtown Whitehorse', 'slug' => 'downtown-whitehorse', 'overview' => "Whitehorse's central core along the Yukon River.", 'latitude' => 60.7212, 'longitude' => -135.0568],
            ],
        ];

        foreach ($areasByCity as $citySlug => $areas) {
            $cityId = DB::table('cities')->where('slug', $citySlug)->value('id');

            if (! $cityId) {
                continue;
            }

            // Insert top-level areas first (no parent_slug), then children,
            // so parent_id can resolve against already-inserted rows.
            $topLevel = collect($areas)->filter(fn ($a) => empty($a['parent_slug']));
            $children = collect($areas)->filter(fn ($a) => ! empty($a['parent_slug']));

            foreach ($topLevel as $area) {
                DB::table('areas')->insert([
                    'city_id' => $cityId,

                    'name' => $area['name'],
                    'slug' => $area['slug'],
                    'overview' => $area['overview'],
                    'latitude' => $area['latitude'],
                    'longitude' => $area['longitude'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($children as $area) {
                $parentId = DB::table('areas')->where('slug', $area['parent_slug'])->value('id');

                DB::table('areas')->insert([
                    'city_id' => $cityId,
                    'name' => $area['name'],
                    'slug' => $area['slug'],
                    'overview' => $area['overview'],
                    'latitude' => $area['latitude'],
                    'longitude' => $area['longitude'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}