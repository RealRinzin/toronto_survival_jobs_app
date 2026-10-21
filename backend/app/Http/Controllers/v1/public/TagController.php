<?php

namespace App\Http\Controllers\v1\public;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\public\TagResource;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $start = microtime(true);
        $tags = Cache::remember(
            'tags:active',
            now()->addHours(1),
            function () {
                return TagResource::collection(
                    Tag::active()
                        ->with('jobListings.company','jobListings.employmentType','jobListings.jobCategory')
                        ->withCount('jobListings')
                        ->has('jobListings', '>', 1)
                        ->orderBy('name')
                        ->get()
                )->resolve();
            }
        );
        Log::info('Tag - total : ' . round((microtime(true) - $start) * 1000, 2) . ' ms');
        return response()->json(['data' => $tags]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
