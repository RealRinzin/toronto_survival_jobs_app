<?php

namespace App\Http\Controllers\v1\public;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\public\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cities = City::active()->with(['province','areas','jobListings'])->get();
        return CityResource::collection($cities);
    }


    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
        return new CityResource($city);
    }
}
