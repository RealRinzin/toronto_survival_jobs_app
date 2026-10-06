<?php

use App\Http\Controllers\v1\public\BusinessCategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/business_categories', BusinessCategoryController::class)->only(['index','show']);
