<?php

namespace App\Support;

use App\Models\JobCategory;
use Illuminate\Support\Facades\Cache;

class TextHelper
{
    /* -------------------------------------------------------------
     | Job Category Role Check Function
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
}
