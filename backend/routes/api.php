<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// routes/api.php
// routes/api.php
Route::prefix('v1')->group(function () {
    Route::prefix('admin')
        ->middleware(['auth:sanctum', 'admin'])
        ->group(function () {
            foreach (glob(base_path('routes/api/v1/admin/*.php')) as $route) {
                require $route;
            }
        });

    Route::group([], function () {
        foreach (glob(base_path('routes/api/v1/public/*.php')) as $route) {
            require $route;
        }
    });
});