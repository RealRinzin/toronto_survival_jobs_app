<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    /** @use HasFactory<\Database\Factories\ProvinceFactory> */
    use HasFactory;
    /* -------------------------------------------------------------
     | Hide Field
     |-------------------------------------------------------------*/
    protected $hidden = ['created_at', 'updated_at'];
    
    /* -------------------------------------------------------------
     | Cast protect
     |-------------------------------------------------------------*/
    protected function casts(): array
    {
        return ['active' => 'boolean'];
    }

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

    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }


    /* -------------------------------------------------------------
     | Scopes
     |-------------------------------------------------------------*/

    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
