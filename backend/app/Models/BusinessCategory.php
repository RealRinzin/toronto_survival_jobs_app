<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    /** @use HasFactory<\Database\Factories\BusinessCategoryFactory> */


// RELATIONSHIP TABLES
public function companies(){
    return $this->hasMany(Company::class);
}

    use HasFactory;
}
