<?php

use App\Http\Controllers\v1\public\ProvinceController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/provinces', ProvinceController::class);
