<?php

namespace App\Support;

use App\Models\City;
use App\Models\EmploymentType;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Cache;

class TextHelper
{
    /* -------------------------------------------------------------
     | JOB CATEGORY CHECKER
     |-------------------------------------------------------------*/
    public static function JobRoleCategoryChecker(string $companyRoleName): int
    {
        $jobCategories = Cache::remember('job_categories', 3600, fn() => JobCategory::select('name', 'id')->get()->toArray());
        foreach ($jobCategories as $category) {
            similar_text(mb_strtolower($category['name']), mb_strtolower($companyRoleName), $percent);
            if (round($percent, 2) > 50) {
                // echo $category;
                return $category['id'];
            }
            return 2;
        }
    }
    /* -------------------------------------------------------------
     | EMPLOYMENT TYPE CHECKER
     |-------------------------------------------------------------*/
    public static function EmploymentTypeChecker(string $employmentTypeName): int
    {
        $employmentTypes = Cache::remember('employment_types', 3600, fn() => EmploymentType::select('name', 'id')->get()->toArray());
        foreach ($employmentTypes as $type) {
            // echo $type['id'];
            similar_text(mb_strtolower($type['name']), mb_strtolower($employmentTypeName), $percent);
            if (round($percent, 2) > 70) {
                return $type['id'];
            }
            return 3;
        }
    }

    /* -------------------------------------------------------------
     | CITY TYPE CHECKER
     |-------------------------------------------------------------*/
    public static function CityChecker(string $cityName)
    {
        $cities = Cache::remember('cities', 3600, fn() => City::select('name', 'id')->get()->toArray());
        foreach ($cities as $city) {
            similar_text(mb_strtolower($city['name']), mb_strtolower($cityName), $percent);
            if (round($percent, 2) > 70) {
                return $city['id'];
            }
            return 3;
        }
    }
}
