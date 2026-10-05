<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    /** @use HasFactory<\Database\Factories\BusinessCategoryFactory> */
    use HasFactory;



    /* -------------------------------------------------------------
     | Slug Route
     |-------------------------------------------------------------*/
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* -------------------------------------------------------------
     | Relationships
     |-------------------------------------------------------------*/
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
    /* -------------------------------------------------------------
     | Scopes
     |-------------------------------------------------------------*/

    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
