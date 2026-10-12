<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapeCompanyJob extends Model
{
    //
    use HasFactory;

    /* -------------------------------------------------------------
     | Hide Field
     |-------------------------------------------------------------*/
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = ['request_body' => 'array'];
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
