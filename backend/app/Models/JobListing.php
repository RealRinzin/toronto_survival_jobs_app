<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    /** @use HasFactory<\Database\Factories\JobListingFactory> */
    use HasFactory;

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
    //  Companies
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    // Categories
    public function jobCategory(){
        return $this->belongsTo(JobCategory::class);
    }
    // Employment Type
    public function employmentType(){
        return $this->belongsTo(EmploymentType::class);
    }
    // Province
    public function province(){
        return $this->belongsTo(Province::class);
    }
    // City
    public function city(){
        return $this->belongsTo(City::class);
    }
    // Tags
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    /* -------------------------------------------------------------
     | Scopes
     |-------------------------------------------------------------*/
    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
