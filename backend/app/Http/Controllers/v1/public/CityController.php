<?php

namespace App\Http\Controllers\v1\public;

use App\Http\Controllers\Controller;
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
        return City::active()->orderBy('name', 'asc')->get();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
