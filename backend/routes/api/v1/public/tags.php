<?php

use App\Http\Controllers\v1\public\TagController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/tags', TagController::class)->only(['index','show']);
