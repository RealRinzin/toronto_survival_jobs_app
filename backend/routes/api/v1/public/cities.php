<?php

use App\Http\Controllers\v1\public\CityController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/cities', CityController::class);
