<?php

namespace App\Support;

use App\Models\City;
use App\Models\EmploymentType;
use App\Models\JobCategory;
use App\Models\Province;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

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
    public static function CityChecker(string $cityName): int
    {
        $cities = Cache::remember('cities', 3600, fn() => City::select('name', 'id', 'province_id')->get()->toArray());
        foreach ($cities as $city) {
            if (stripos($cityName, $city['name']) !== false) {
                return $city['id'];
                break;
            }
            return 4;
        }
    }
    /* -------------------------------------------------------------
     | PROVINCE TYEP CHECKER
     |-------------------------------------------------------------*/
    public static function ProvinceChecker(string $cityName): int
    {
        $cities = Cache::remember('cities', 3600, fn() => City::select('name', 'id', 'province_id')->get()->toArray());
        foreach ($cities as $city) {
            if (stripos($cityName, $city['name']) !== false) {
                return $city['province_id'];
                break;
            }
            return 4;
        }
    }
    /* -------------------------------------------------------------
     | Area TYEP CHECKER
     |-------------------------------------------------------------*/

    public static function MatchAreaCityProvinceChecker(string $table, string $name, string $field, Model $model):int
    {
        $lists = Cache::remember($table, 3600, fn() => $model::select('id', 'name', $field)->get()->toArray());
        foreach ($lists as $list) {
            if (stripos(mb_strtolower($name), mb_strtolower($list['name'])) !== false) {
                return  $list['id'];
                break;
            }
        }
        return 1;
    }
}
