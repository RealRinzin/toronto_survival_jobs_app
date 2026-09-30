<?php

use App\Http\Controllers\v1\admin\CompanyController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/companies', CompanyController::class);

Route::prefix('companies')->group(function () {
    Route::get('{company}/jobs', [CompanyController::class, 'jobs']);

    Route::get('{company}/scraping', [CompanyController::class, 'scraping']);

    Route::post('{company}/activate', [CompanyController::class, 'activate']);
});