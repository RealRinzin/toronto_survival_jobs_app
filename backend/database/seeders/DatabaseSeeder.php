<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use App\Models\Company;
use App\Models\ScrapeCompanyJob;
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

        $this->call([
            BusinessCategorySeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            // CompanySeeder::class,
            // ScrapePlatformSeeder::class,
            AreaSeeder::class,
            EmploymentTypeSeeder::class,
            JobCategorySeeder::class
        ]);
        Company::factory(20)->create();
        ScrapePlatform::factory(20)->create();
        ScrapeCompanyJob::factory(1)->create();
    }
}
