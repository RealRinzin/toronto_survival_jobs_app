<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companies = [
            [
                'name' => 'Best Buy',
                'overview' => 'Providing entry-level warehouse, order picking, and overnight shift positions with flexible hours and weekly pay.',
                'website' => 'https://apexlogistics.example.com',
                'logo' => 'best_buy.svg',
                'brand_color' => '#0046BE'
            ],
            [
                'name' => 'Healthy Planet',
                'overview' => 'Same-day urban parcel delivery hiring independent drivers, bike couriers, and sortation staff.',
                'website' => 'https://swiftcourier.example.com',
                'logo' => 'healthy_planet.svg',
                'brand_color' => "#005568"
            ],
            [
                'name' => 'Tim Hortons',
                'overview' => 'Commercial cleaning and maintenance services offering part-time and full-time night shift positions.',
                'website' => 'https://urbancleaners.example.com',
                'logo' => 'tim_hortons.svg',

                'brand_color' => "#C8102E"
            ],
            [
                'name' => 'A & W',
                'overview' => 'On-demand cashier, shelf-stocking, and seasonal retail support for major supermarket chains.',
                'website' => 'https://metroretail.example.com',
                'logo' => 'a_w.svg',

                'brand_color' => "#FFFFFF"
            ],
            [
                'name' => 'Adidas',
                'overview' => 'A gig-economy food delivery platform with immediate start dates for drivers and riders.',
                'website' => 'https://quickbite.example.com',
                'logo' => 'adidas.svg',

                'brand_color' => "#000"

            ],
            [
                'name' => 'Nike',
                'overview' => 'Entry-level security guard and event monitoring positions requiring minimal prior experience.',
                'website' => 'https://harborsecurity.example.com',
                'logo' => 'nike.svg',

                'brand_color' => "#000"

            ],
            [
                'name' => 'Chipotle',
                'overview' => 'Seasonal landscaping, lawn maintenance, and outdoor labor opportunities across metropolitan areas.',
                'website' => 'https://greenscape.example.com',
                'logo' => 'chipotle.svg',

                'brand_color' => "#fff"

            ],
            [
                'name' => 'ProCall Customer Support',
                'overview' => 'Work-from-home inbound customer care and tech support roles with paid training provided.',
                'website' => 'https://procallsupport.example.com',
                'logo' => 'https://procallsupport.example.com',
                'brand_color' => "#005568"

            ],
            [
                'name' => 'SunRays Hospitality & Catering',
                'overview' => 'Event staffing agency recruiting servers, dishwashers, and banquet prep assistants for weekend shifts.',
                'website' => 'https://sunrayscatering.example.com',
                'logo' => 'https://sunrayscatering.example.com',
                'brand_color' => "#005568"
            ],
            [
                'name' => 'FlexiDrive Rideshare',
                'overview' => 'Flexible driver platform helping workers earn income on their own schedule using personal vehicles.',
                'website' => 'https://flexidrive.example.com',
                'logo' => 'https://flexidrive.example.com',
                'brand_color' => "#005568"

            ],
            [
                'name' => 'FirstStep Moving & Storage',
                'overview' => 'Residential and commercial moving services hiring loaders, drivers, and packing specialists.',
                'website' => 'https://firststepmoving.example.com',
                'logo' => 'https://taskrunner.example.com',

                'brand_color' => "#005568"

            ],
            [
                'name' => 'CareGiver Direct',
                'overview' => 'In-home non-medical caregiving and companionship roles with flexible scheduling for hourly workers.',
                'website' => 'https://caregiverdirect.example.com',
                'logo' => 'https://taskrunner.example.com',

                'brand_color' => "#005568"

            ],
            [
                'name' => 'FreshMarket Superstores',
                'overview' => 'Regional grocery chain providing immediate openings for inventory clerks and deli staff.',
                'website' => 'https://freshmarkets.example.com',
                'logo' => 'https://ecoshineautowash.example.com',

                'brand_color' => "#005568"

            ],
            [
                'name' => 'TaskRunner On-Demand',
                'overview' => 'Platform connecting workers with local day-labor tasks, home repairs, and assembly work.',
                'website' => 'https://taskrunner.example.com',
                'logo' => 'https://taskrunner.example.com',
                'brand_color' => "#005568"

            ],
            [
                'name' => 'NightOwl Hotel Operations',
                'overview' => 'Boutique hotel chain offering front-desk, housekeeping, and night audit shifts.',
                'website' => 'https://nightowlhotels.example.com',
                'logo' => 'https://ecoshineautowash.example.com',

                'brand_color' => "#005568"

            ],
            [
                'name' => 'BuildCore Construction Helpers',
                'overview' => 'Temporary staffing for general construction site cleanup, material handling, and basic site prep.',
                'website' => 'https://buildcorehelpers.example.com',
                'logo' => 'https://ecoshineautowash.example.com',

                'brand_color' => "#005568"

            ],
            [
                'name' => 'Precision Assembly Line',
                'overview' => 'Light industrial manufacturing hiring packaging operators and quality control assistants.',
                'website' => 'https://precisionassembly.example.com',
                'logo' => 'https://ecoshineautowash.example.com',

                'brand_color' => "#005568"

            ],
            [
                'name' => 'EcoShine Auto Wash',
                'overview' => 'Car wash facilities offering immediate entry-level attendant and detailer roles.',
                'website' => 'https://ecoshineautowash.example.com',
                'logo' => 'https://ecoshineautowash.example.com',
                'brand_color' => "#005568"

            ],
            [
                'name' => 'FastTrack Fulfillment',
                'overview' => 'E-commerce fulfillment centers hiring seasonal packers and shipping processors.',
                'website' => 'https://fasttrackfulfillment.example.com',
                'logo' => 'https://fasttrackfulfillment.example.com',
                'brand_color' => "#005568"

            ],
            [
                'name' => 'ParkQuick Valet & Parking',
                'overview' => 'Commercial parking lot management seeking valet drivers and booth attendants.',
                'website' => 'https://parkquick.example.com',
                'logo' => 'https://parkquick.example.com',
                'brand_color' => "#005568"

            ],
        ];

        // Randomly pick one from the predefined list
        $company = $this->faker->unique()->randomElement($companies);
        return [
            'name' => $company['name'],
            'slug' => Str::slug($company['name']),
            'overview' => $company['overview'],
            'website' => $company['website'],
            'logo' => $company['logo'],
            'brand_color' => $company['brand_color'],
            'business_category_id' => rand(1, 10)
        ];
    }
}
