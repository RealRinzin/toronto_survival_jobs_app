<?php

use App\Http\Controllers\v1\public\EmploymentTypeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/employment_types', EmploymentTypeController::class);
