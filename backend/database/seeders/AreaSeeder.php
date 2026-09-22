<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Areas are grouped by the parent city's slug (must match CitySeeder).
     * Each city uses its most recognizable "major" districts/neighbourhoods
     * rather than exhaustive official planning lists:
     *   - Toronto: a curated subset of well-known neighbourhoods
     *   - Montreal: all 19 official boroughs (arrondissements)
     *   - Vancouver: all 22 official local areas
     *   - Calgary: well-known inner-city neighbourhoods
     *
     * Coordinates are left null — add them if/when you have verified
     * per-area lat/lng. More cities are added incrementally below.
     * Safe to re-run (upserts on slug).
     */
    public function run(): void
    {
        $areasByCity = [

            'toronto' => [
                ['name' => 'Annex', 'slug' => 'annex', 'overview' => 'Annex is a well-known midtown neighbourhood near the University of Toronto, known for Victorian houses and a lively student scene in toronto.'],
                ['name' => 'Rosedale-Moore Park', 'slug' => 'rosedale-moore-park', 'overview' => 'Rosedale-Moore Park is one of Toronto\'s most affluent and historic residential neighbourhoods, known for grand homes and ravines in toronto.'],
                ['name' => 'Kensington-Chinatown', 'slug' => 'kensington-chinatown', 'overview' => 'Kensington-Chinatown is a vibrant, multicultural downtown district known for its market, independent shops, and food scene in toronto.'],
                ['name' => 'Church-Wellesley', 'slug' => 'church-wellesley', 'overview' => 'Church-Wellesley is downtown Toronto\'s LGBTQ+ village, known for its nightlife and community events in toronto.'],
                ['name' => 'Fort York-Liberty Village', 'slug' => 'fort-york-liberty-village', 'overview' => 'Fort York-Liberty Village is a redeveloped former industrial district known for condos, offices, and nightlife in toronto.'],
                ['name' => 'Cabbagetown-South St. James Town', 'slug' => 'cabbagetown-south-st-james-town', 'overview' => 'Cabbagetown-South St. James Town is a historic downtown neighbourhood known for its Victorian architecture in toronto.'],
                ['name' => 'The Beaches', 'slug' => 'the-beaches', 'overview' => 'The Beaches is a lakeside neighbourhood in the city\'s east end known for its boardwalk and beach in toronto.'],
                ['name' => 'High Park-Swansea', 'slug' => 'high-park-swansea', 'overview' => 'High Park-Swansea is a west-end neighbourhood centred on Toronto\'s largest park, High Park in toronto.'],
                ['name' => 'Roncesvalles', 'slug' => 'roncesvalles', 'overview' => 'Roncesvalles is a west-end neighbourhood known for its Polish heritage and walkable main street in toronto.'],
                ['name' => 'Junction Area', 'slug' => 'junction-area', 'overview' => 'Junction Area is a west-end neighbourhood known for its former industrial buildings turned shops and restaurants in toronto.'],
                ['name' => 'Little Portugal', 'slug' => 'little-portugal', 'overview' => 'Little Portugal is a west-end downtown neighbourhood historically home to Toronto\'s Portuguese community in toronto.'],
                ['name' => 'Palmerston-Little Italy', 'slug' => 'palmerston-little-italy', 'overview' => 'Palmerston-Little Italy is a downtown neighbourhood known for College Street\'s Italian restaurants and bars in toronto.'],
                ['name' => 'Trinity-Bellwoods', 'slug' => 'trinity-bellwoods', 'overview' => 'Trinity-Bellwoods is a downtown neighbourhood centred on the popular Trinity Bellwoods Park in toronto.'],
                ['name' => 'West Queen West', 'slug' => 'west-queen-west', 'overview' => 'West Queen West is a downtown arts and fashion district known for galleries and boutiques in toronto.'],
                ['name' => 'Yonge-Eglinton', 'slug' => 'yonge-eglinton', 'overview' => 'Yonge-Eglinton is a midtown commercial and residential hub around Yonge and Eglinton in toronto.'],
                ['name' => 'North Toronto', 'slug' => 'north-toronto', 'overview' => 'North Toronto is a midtown residential district north of downtown in toronto.'],
                ['name' => 'Yonge-St. Clair', 'slug' => 'yonge-st-clair', 'overview' => 'Yonge-St. Clair is a midtown neighbourhood along Yonge Street near St. Clair Avenue in toronto.'],
                ['name' => 'Casa Loma', 'slug' => 'casa-loma', 'overview' => 'Casa Loma is a midtown neighbourhood named for the landmark Casa Loma castle in toronto.'],
                ['name' => 'Forest Hill South', 'slug' => 'forest-hill-south', 'overview' => 'Forest Hill South is an affluent midtown residential neighbourhood in toronto.'],
                ['name' => 'Leaside-Bennington', 'slug' => 'leaside-bennington', 'overview' => 'Leaside-Bennington is a midtown residential neighbourhood in the former borough of East York in toronto.'],
            ],

            'montreal' => [
                ['name' => 'Ahuntsic-Cartierville', 'slug' => 'ahuntsic-cartierville', 'overview' => 'Ahuntsic-Cartierville is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Anjou', 'slug' => 'anjou', 'overview' => 'Anjou is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Côte-des-Neiges–Notre-Dame-de-Grâce', 'slug' => 'c-te-des-neiges-notre-dame-de-gr-ce', 'overview' => 'Côte-des-Neiges–Notre-Dame-de-Grâce is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Lachine', 'slug' => 'lachine', 'overview' => 'Lachine is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'LaSalle', 'slug' => 'lasalle', 'overview' => 'LaSalle is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Le Plateau-Mont-Royal', 'slug' => 'le-plateau-mont-royal', 'overview' => 'Le Plateau-Mont-Royal is one of the 19 official boroughs of Montreal, known for its cafes and heritage architecture in montreal.'],
                ['name' => 'Le Sud-Ouest', 'slug' => 'le-sud-ouest', 'overview' => 'Le Sud-Ouest is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'LÎle-Bizard–Sainte-Geneviève', 'slug' => 'l-le-bizard-sainte-genevi-ve', 'overview' => 'Île-Bizard–Sainte-Geneviève is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Mercier–Hochelaga-Maisonneuve', 'slug' => 'mercier-hochelaga-maisonneuve', 'overview' => 'Mercier–Hochelaga-Maisonneuve is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Montréal-Nord', 'slug' => 'montr-al-nord', 'overview' => 'Montréal-Nord is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Outremont', 'slug' => 'outremont', 'overview' => 'Outremont is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Pierrefonds-Roxboro', 'slug' => 'pierrefonds-roxboro', 'overview' => 'Pierrefonds-Roxboro is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Rivière-des-Prairies–Pointe-aux-Trembles', 'slug' => 'rivi-re-des-prairies-pointe-aux-trembles', 'overview' => 'Rivière-des-Prairies–Pointe-aux-Trembles is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Rosemont–La Petite-Patrie', 'slug' => 'rosemont-la-petite-patrie', 'overview' => 'Rosemont–La Petite-Patrie is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Saint-Laurent', 'slug' => 'saint-laurent', 'overview' => 'Saint-Laurent is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Saint-Léonard', 'slug' => 'saint-l-onard', 'overview' => 'Saint-Léonard is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Verdun', 'slug' => 'verdun', 'overview' => 'Verdun is one of the 19 official boroughs of Montreal in montreal.'],
                ['name' => 'Ville-Marie', 'slug' => 'ville-marie', 'overview' => 'Ville-Marie is one of the 19 official boroughs of Montreal, containing Downtown Montreal and Old Montreal in montreal.'],
                ['name' => 'Villeray–Saint-Michel–Parc-Extension', 'slug' => 'villeray-saint-michel-parc-extension', 'overview' => 'Villeray–Saint-Michel–Parc-Extension is one of the 19 official boroughs of Montreal in montreal.'],
            ],

            'vancouver' => [
                ['name' => 'Arbutus Ridge', 'slug' => 'arbutus-ridge', 'overview' => 'Arbutus Ridge is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Downtown', 'slug' => 'downtown', 'overview' => 'Downtown is Vancouver\'s central business district, one of the city\'s 22 official local areas in vancouver.'],
                ['name' => 'Dunbar-Southlands', 'slug' => 'dunbar-southlands', 'overview' => 'Dunbar-Southlands is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Fairview', 'slug' => 'fairview', 'overview' => 'Fairview is one of the 22 official local areas of Vancouver, home to Granville Island in vancouver.'],
                ['name' => 'Grandview-Woodland', 'slug' => 'grandview-woodland', 'overview' => 'Grandview-Woodland is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Hastings-Sunrise', 'slug' => 'hastings-sunrise', 'overview' => 'Hastings-Sunrise is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Kensington-Cedar Cottage', 'slug' => 'kensington-cedar-cottage', 'overview' => 'Kensington-Cedar Cottage is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Kerrisdale', 'slug' => 'kerrisdale', 'overview' => 'Kerrisdale is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Killarney', 'slug' => 'killarney', 'overview' => 'Killarney is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Kitsilano', 'slug' => 'kitsilano', 'overview' => 'Kitsilano is one of the 22 official local areas of Vancouver, known for its beach in vancouver.'],
                ['name' => 'Marpole', 'slug' => 'marpole', 'overview' => 'Marpole is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Mount Pleasant', 'slug' => 'mount-pleasant', 'overview' => 'Mount Pleasant is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Oakridge', 'slug' => 'oakridge', 'overview' => 'Oakridge is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Renfrew-Collingwood', 'slug' => 'renfrew-collingwood', 'overview' => 'Renfrew-Collingwood is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Riley Park', 'slug' => 'riley-park', 'overview' => 'Riley Park is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Shaughnessy', 'slug' => 'shaughnessy', 'overview' => 'Shaughnessy is one of the 22 official local areas of Vancouver, known for its heritage homes in vancouver.'],
                ['name' => 'South Cambie', 'slug' => 'south-cambie', 'overview' => 'South Cambie is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Strathcona', 'slug' => 'strathcona', 'overview' => 'Strathcona is one of the 22 official local areas of Vancouver, one of the city\'s oldest neighbourhoods in vancouver.'],
                ['name' => 'Sunset', 'slug' => 'sunset', 'overview' => 'Sunset is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'Victoria-Fraserview', 'slug' => 'victoria-fraserview', 'overview' => 'Victoria-Fraserview is one of the 22 official local areas of Vancouver in vancouver.'],
                ['name' => 'West End', 'slug' => 'west-end', 'overview' => 'West End is one of the 22 official local areas of Vancouver, a dense residential district near Stanley Park in vancouver.'],
                ['name' => 'West Point Grey', 'slug' => 'west-point-grey', 'overview' => 'West Point Grey is one of the 22 official local areas of Vancouver in vancouver.'],
            ],

            'calgary' => [
                ['name' => 'Downtown', 'slug' => 'downtown', 'overview' => 'Downtown is Calgary\'s central business district in calgary.'],
                ['name' => 'Beltline', 'slug' => 'beltline', 'overview' => 'Beltline is a dense, walkable neighbourhood just south of downtown in calgary.'],
                ['name' => 'Eau Claire', 'slug' => 'eau-claire', 'overview' => 'Eau Claire is a downtown-adjacent neighbourhood along the Bow River in calgary.'],
                ['name' => 'Chinatown', 'slug' => 'chinatown', 'overview' => 'Chinatown is a historic ethnic enclave adjacent to downtown Calgary in calgary.'],
                ['name' => 'Kensington', 'slug' => 'kensington', 'overview' => 'Kensington is a neighbourhood on the north bank of the Bow River known for shops and cafes in calgary.'],
                ['name' => 'Inglewood', 'slug' => 'inglewood', 'overview' => 'Inglewood is Calgary\'s oldest neighbourhood, known for its main street of boutiques in calgary.'],
                ['name' => 'Mission', 'slug' => 'mission', 'overview' => 'Mission is a neighbourhood along the Elbow River known for heritage buildings and dining in calgary.'],
                ['name' => 'East Village', 'slug' => 'east-village', 'overview' => 'East Village is a redeveloped riverside district next to downtown in calgary.'],
                ['name' => 'Bridgeland', 'slug' => 'bridgeland', 'overview' => 'Bridgeland is an inner-city neighbourhood northeast of downtown in calgary.'],
                ['name' => 'Marda Loop', 'slug' => 'marda-loop', 'overview' => 'Marda Loop is an inner-city neighbourhood known for shops and restaurants in calgary.'],
            ],
            // Add more cities here, e.g.:
            // 'edmonton' => [
            //     ['name' => '...', 'slug' => '...', 'overview' => '...'],
            // ],
        ];

        foreach ($areasByCity as $citySlug => $areas) {
            $cityId = DB::table('cities')->where('slug', $citySlug)->value('id');

            if (! $cityId) {
                $this->command?->warn("Skipping areas for '{$citySlug}': city not found. Run CitySeeder first.");
                continue;
            }

            foreach ($areas as $area) {
                DB::table('areas')->updateOrInsert(
                    ['slug' => $area['slug']],
                    [
                        'name' => $area['name'],
                        'overview' => $area['overview'],
                        'latitude' => $area['latitude'] ?? null,
                        'longitude' => $area['longitude'] ?? null,
                        'active' => false,
                        'city_id' => $cityId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}
