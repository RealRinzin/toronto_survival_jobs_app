<?php

namespace App\Http\Controllers\v1\public;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\public\AreaResource;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $start = microtime(true);
        $areas = Cache::remember('areas:active', now()->addHours(10), function () {
            return AreaResource::collection(
                Area::active()->with(['city', 'jobListings'])->get()
            )->resolve();
        });
        // Log::info('total: ' . round((microtime(true) - $start) * 1000, 2) . ' ms');
        return response()->json(['data' => $areas]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }
}
