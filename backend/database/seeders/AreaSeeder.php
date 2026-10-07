<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // city slug => [[name, latitude, longitude], ...]
        $neighborhoods = [
            'toronto' => [
                ['Etobicoke', 43.6536, -79.5413],
                ['North York', 43.7615, -79.4111],
                ['Scarborough', 43.7764, -79.2318],
                ['Toronto',51.0447, -114.0719,],
            ],
            'vancouver' => [
                ['Gastown', 49.2837, -123.1088],
                ['Yaletown', 49.2746, -123.1216],
                ['Kitsilano', 49.2684, -123.1552],
                ['Mount Pleasant', 49.2632, -123.1006],
                ['West End', 49.2844, -123.1359],
                ['Commercial Drive', 49.2694, -123.0695],
            ],
            'montreal' => [
                ['Old Montreal', 45.5045, -73.5540],
                ['Plateau-Mont-Royal', 45.5200, -73.5800],
                ['Mile End', 45.5236, -73.6009],
                ['Griffintown', 45.4930, -73.5590],
                ['Outremont', 45.5150, -73.6100],
                ['Verdun', 45.4590, -73.5720],
            ],
            'calgary' => [
                ['Beltline', 51.0393, -114.0716],
                ['Kensington', 51.0528, -114.0870],
                ['Inglewood', 51.0384, -114.0284],
            ],
            'ottawa' => [
                ['ByWard Market', 45.4290, -75.6910],
                ['The Glebe', 45.3990, -75.6900],
                ['Westboro', 45.3920, -75.7580],
                ['Centretown', 45.4160, -75.6970],
            ],
            'edmonton' => [
                ['Old Strathcona', 53.5190, -113.4990],
                ['Oliver', 53.5440, -113.5300],
            ],
        ];

        $cityIds = DB::table('cities')->pluck('id', 'slug');

        $rows = [];
        foreach ($neighborhoods as $citySlug => $list) {
            foreach ($list as [$name, $lat, $lng]) {
                $rows[] = [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'overview' => 'OverView',
                    'latitude' => $lat,
                    'longitude' => $lng,
                    'city_id' => $cityIds[$citySlug] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        // Change 'neighborhoods' below if your third table has a different name
        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('areas')->upsert(
                $chunk,
                ['slug'],
                ['name', 'latitude', 'longitude', 'city_id', 'updated_at']
            );
        }
    }
}
