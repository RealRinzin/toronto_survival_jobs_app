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
                'name' => 'Apex Logistics & Warehousing',
                'overview' => 'Providing entry-level warehouse, order picking, and overnight shift positions with flexible hours and weekly pay.',
                'website' => 'https://apexlogistics.example.com',
            ],
            [
                'name' => 'Swift Courier Services',
                'overview' => 'Same-day urban parcel delivery hiring independent drivers, bike couriers, and sortation staff.',
                'website' => 'https://swiftcourier.example.com',
            ],
            [
                'name' => 'Urban Cleaners & Facility Care',
                'overview' => 'Commercial cleaning and maintenance services offering part-time and full-time night shift positions.',
                'website' => 'https://urbancleaners.example.com',
            ],
            [
                'name' => 'Metro Retail Staffing',
                'overview' => 'On-demand cashier, shelf-stocking, and seasonal retail support for major supermarket chains.',
                'website' => 'https://metroretail.example.com',
            ],
            [
                'name' => 'QuickBite Food Delivery',
                'overview' => 'A gig-economy food delivery platform with immediate start dates for drivers and riders.',
                'website' => 'https://quickbite.example.com',
            ],
            [
                'name' => 'Harbor Security Solutions',
                'overview' => 'Entry-level security guard and event monitoring positions requiring minimal prior experience.',
                'website' => 'https://harborsecurity.example.com',
            ],
            [
                'name' => 'GreenScape Groundskeeping',
                'overview' => 'Seasonal landscaping, lawn maintenance, and outdoor labor opportunities across metropolitan areas.',
                'website' => 'https://greenscape.example.com',
            ],
            [
                'name' => 'ProCall Customer Support',
                'overview' => 'Work-from-home inbound customer care and tech support roles with paid training provided.',
                'website' => 'https://procallsupport.example.com',
            ],
            [
                'name' => 'SunRays Hospitality & Catering',
                'overview' => 'Event staffing agency recruiting servers, dishwashers, and banquet prep assistants for weekend shifts.',
                'website' => 'https://sunrayscatering.example.com',
            ],
            [
                'name' => 'FlexiDrive Rideshare',
                'overview' => 'Flexible driver platform helping workers earn income on their own schedule using personal vehicles.',
                'website' => 'https://flexidrive.example.com',
            ],
            [
                'name' => 'FirstStep Moving & Storage',
                'overview' => 'Residential and commercial moving services hiring loaders, drivers, and packing specialists.',
                'website' => 'https://firststepmoving.example.com',
            ],
            [
                'name' => 'CareGiver Direct',
                'overview' => 'In-home non-medical caregiving and companionship roles with flexible scheduling for hourly workers.',
                'website' => 'https://caregiverdirect.example.com',
            ],
            [
                'name' => 'FreshMarket Superstores',
                'overview' => 'Regional grocery chain providing immediate openings for inventory clerks and deli staff.',
                'website' => 'https://freshmarkets.example.com',
            ],
            [
                'name' => 'TaskRunner On-Demand',
                'overview' => 'Platform connecting workers with local day-labor tasks, home repairs, and assembly work.',
                'website' => 'https://taskrunner.example.com',
            ],
            [
                'name' => 'NightOwl Hotel Operations',
                'overview' => 'Boutique hotel chain offering front-desk, housekeeping, and night audit shifts.',
                'website' => 'https://nightowlhotels.example.com',
            ],
            [
                'name' => 'BuildCore Construction Helpers',
                'overview' => 'Temporary staffing for general construction site cleanup, material handling, and basic site prep.',
                'website' => 'https://buildcorehelpers.example.com',
            ],
            [
                'name' => 'Precision Assembly Line',
                'overview' => 'Light industrial manufacturing hiring packaging operators and quality control assistants.',
                'website' => 'https://precisionassembly.example.com',
            ],
            [
                'name' => 'EcoShine Auto Wash',
                'overview' => 'Car wash facilities offering immediate entry-level attendant and detailer roles.',
                'website' => 'https://ecoshineautowash.example.com',
            ],
            [
                'name' => 'FastTrack Fulfillment',
                'overview' => 'E-commerce fulfillment centers hiring seasonal packers and shipping processors.',
                'website' => 'https://fasttrackfulfillment.example.com',
            ],
            [
                'name' => 'ParkQuick Valet & Parking',
                'overview' => 'Commercial parking lot management seeking valet drivers and booth attendants.',
                'website' => 'https://parkquick.example.com',
            ],
        ];

        // Randomly pick one from the predefined list
        $company = $this->faker->unique()->randomElement($companies);
        return [
            'name' => $company['name'],
            'slug' => Str::slug($company['name']),
            'overview' => $company['overview'],
            'website' => $company['website'],
            'logo' => 'myimage.png',
            'business_category_id' => rand(1,10)
        ];
    }
}
