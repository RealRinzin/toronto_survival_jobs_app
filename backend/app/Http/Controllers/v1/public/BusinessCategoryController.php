<?php

namespace App\Http\Controllers\v1\public;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return BusinessCategory::with('companies')->get();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

}
