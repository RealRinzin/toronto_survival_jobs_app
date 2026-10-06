<?php

use App\Http\Controllers\v1\public\CompanyController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/companies', CompanyController::class)->only(['index','show']);
