<?php

use App\Http\Controllers\v1\public\AreaController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/areas', AreaController::class)->only(['index','show']);
