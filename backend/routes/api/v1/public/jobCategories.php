<?php

use App\Http\Controllers\v1\public\JobCategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/job_categories', JobCategoryController::class);
