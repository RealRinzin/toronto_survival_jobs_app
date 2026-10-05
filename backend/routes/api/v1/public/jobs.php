<?php

use App\Http\Controllers\v1\public\JobListingController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/jobs', JobListingController::class);
