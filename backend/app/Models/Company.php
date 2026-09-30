<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;





    // RELATIONSHIP TABLES
    public function businessCategory(){
        return $this->belongsTo(BusinessCategory::class);
    }

    /** Custom Query functions */
    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }
}
