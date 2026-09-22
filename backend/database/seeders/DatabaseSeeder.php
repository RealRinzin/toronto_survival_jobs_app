<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\ScrapePlatform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Company::factory(20)->create();
        ScrapePlatform::factory(20)->create();
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
            // CompanySeeder::class,
            // ScrapePlatformSeeder::class,
            // AreaSeeder::class,
        ]);
    }
}
