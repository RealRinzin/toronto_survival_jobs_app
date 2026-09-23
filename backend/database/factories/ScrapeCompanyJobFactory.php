<?php

namespace Database\Factories;

use App\Models\ScrapeCompanyJob;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ScrapeCompanyJob>
 */
class ScrapeCompanyJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'company_id' => 1,
            'scrape_platform_id' => 2,
            'base_url' => 'https://google.com',
            'user_agent' => 'Mozilla/5.0(compatible; JobScraper/1.0)',
            // 'request_headers' => json_encode([
            //     'Accept' => 'text/html,application/xhtml+xml,application/xml',
            //     'Accept-Language' => 'en-US,en;q=0.9',
            // ]),
            'scrape_frequency_minutes' => 1 % 2 === 0 ? 360 : 1440,
            'last_scraped_at' => now()->subHours(1 + 1),
            'active' => true,
        ];
    }
}
