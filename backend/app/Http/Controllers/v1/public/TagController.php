<?php

namespace App\Http\Controllers\v1\public;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\public\TagResource;
use App\Http\Resources\v1\public\TagResourceCollection;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return TagResource::get();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

}
