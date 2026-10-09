<?php

namespace App\Http\Controllers\v1\public;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\public\JobCategoryResource;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Getting the 
    }
 
    /**
     * Display the specified resource.
     */
    public function show(JobCategory $jobCategory)
    {
        //
        return new JobCategoryResource($jobCategory);

    }

    /**
     *  Meta data for the job categories
     */
    public function meta_data()
    {
        $jobCategories = JobCategory::withCount([
            'jobListings' => fn($query) => $query->where('active', true),
        ])->get();
        return JobCategoryResource::collection($jobCategories);
    }
}
