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
     | Proince and City  TYEP CHECKER
     |-------------------------------------------------------------*/

    public static function MatchCityProvinceChecker(string $target, string $table, string $name, string $field, Model $model): int
    {
        $lists = Cache::remember($table, 3600, fn() => $model::select('id', 'name', $field)->get()->toArray());
        foreach ($lists as $list) {
            if (stripos($name, $list['name']) !== false) {
                return $target === 'city' ? $list['id'] : $list['province_id'];
                break;
            }
        }
        return 6;
    }

    /* -------------------------------------------------------------
     | Area TYEP CHECKER
     |-------------------------------------------------------------*/
    public static function AreaChecker(string $name): int
    {
        $cities = Cache::remember('cities', 3600, fn() => City::select('id', 'name')->with('areas:id,name,city_id')->get()->toArray());
        foreach ($cities as $city) {
            if (stripos($name, $city['name']) !== false) {
                foreach ($city['areas'] as $targetCity) {
                    if (stripos($city['name'], $targetCity['name']) !== false) {
                        return $targetCity['city_id'];
                        break;
                    }
                }
                break;
            }
        }
        return 3;
    }
}
