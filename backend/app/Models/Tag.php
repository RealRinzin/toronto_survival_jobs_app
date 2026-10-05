<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at', 'pivot'];
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

     public function jobListings(){
        return $this->belongsToMany(JobListing::class);
     }
    /* -------------------------------------------------------------
     | Scopes
     |-------------------------------------------------------------*/
    public function scopeActive(EloquentBuilder $query): void
    {
        $query->where('active', true);
    }
}
