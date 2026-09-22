<?php

namespace Database\Factories;

use App\Models\ScrapePlatform;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends Factory<ScrapePlatform>
 */
class ScrapePlatformFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // API platforms
        $platforms = [
            ['name' => 'LinkedIn Jobs API', 'scrape_method' => 'api'],
            ['name' => 'Indeed Publisher API', 'scrape_method' => 'api'],
            ['name' => 'Greenhouse ATS API', 'scrape_method' => 'api'],
            ['name' => 'Lever ATS API', 'scrape_method' => 'api'],
            ['name' => 'SmartRecruiters API', 'scrape_method' => 'api'],
            ['name' => 'Ashby ATS API', 'scrape_method' => 'api'],

            // HTML Scrape / Headless Browser platforms
            ['name' => 'Workday Candidate Portal', 'scrape_method' => 'html'],
            ['name' => 'Taleo Career Site', 'scrape_method' => 'html'],
            ['name' => 'BambooHR Jobs Page', 'scrape_method' => 'html'],
            ['name' => 'iCIMS Talent Cloud', 'scrape_method' => 'html'],
            ['name' => 'Glassdoor Careers', 'scrape_method' => 'html'],
            ['name' => 'Custom HTML Parser', 'scrape_method' => 'html'],
            ['name' => 'Jobvite Portal', 'scrape_method' => 'html'],
            ['name' => 'SuccessFactors ATS', 'scrape_method' => 'html'],

            // RSS / XML Feed platforms
            ['name' => 'ZipRecruiter RSS Feed', 'scrape_method' => 'rss'],
            ['name' => 'SimplyHired XML Feed', 'scrape_method' => 'rss'],
            ['name' => 'Monster Job Feed', 'scrape_method' => 'rss'],
            ['name' => 'Upwork RSS Feed', 'scrape_method' => 'rss'],
            ['name' => 'WeWorkRemotely RSS', 'scrape_method' => 'rss'],
            ['name' => 'RemoteOK Jobs Feed', 'scrape_method' => 'rss'],
        ];

        $platform = $this->faker->unique()->randomElement($platforms);

        return [
            'name' => $platform['name'],
            'slug' => Str::slug($platform['name']),
            'scrape_method' => $platform['scrape_method'],
        ];
    }
}
