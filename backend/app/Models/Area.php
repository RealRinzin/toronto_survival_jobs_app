<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /** @use HasFactory<\Database\Factories\AreaFactory> */
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
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function jobListings()
    {
        return $this->hasMany(JobListing::class);
    }
    /* -------------------------------------------------------------
     | Scopes
     |-------------------------------------------------------------*/

    public function scopeActive(Builder $query): void
    {
        $query->where('active', false);
    }
}
