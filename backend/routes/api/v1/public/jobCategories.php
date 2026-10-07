<?php

use App\Http\Controllers\v1\public\JobCategoryController;
use Illuminate\Support\Facades\Route;


Route::prefix('job_categories')->group(function () {
    Route::get('meta_data', [JobCategoryController::class, 'meta_data']);
    // API Resources
    Route::apiResource('/', JobCategoryController::class)
        ->only(['index', 'show'])->parameters(['' => 'jobCategory']);
});
