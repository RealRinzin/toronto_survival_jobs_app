<?php

namespace App\Http\Controllers\v1\public;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\public\JobListingResource;
use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $jobs = JobListing::active()->with(['company','jobCategory','employmentType','province','city','area','tags'])->cursorPaginate(10);
        return JobListingResource::collection($jobs);

    }

    /**
     * Display the specified resource.
     */
    public function show(JobListing $job)
    {
        //
        $job->load(['company','province','city','jobCategory']);
        return new JobListingResource($job);
    }

}
