<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    /* -------------------------------------------------------------
     | Fillable fields
     |-------------------------------------------------------------*/
    protected $fillable = [
        'name',
        'overview',
        'website',
        'brand_color',
        'logo',
        'company_size',
        'founded',
        'headquarters',
        'active'
    ];


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
    /** businessCategory */
    public function businessCategory()
    {
        return $this->belongsTo(BusinessCategory::class);
    }
    /** jobListings */
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
