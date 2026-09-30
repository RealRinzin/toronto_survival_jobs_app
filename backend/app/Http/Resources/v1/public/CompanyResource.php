<?php

namespace App\Http\Resources\v1\public;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'overview' => $this->overview,
            'website' => $this->website,
            'brand_color' => $this->brand_color,
            'logo' => $this->logo,
            'company_size' => $this->company_size,
            'founded' => $this->founded,
            'headquaters' => $this->headquaters,
            'active' => $this->active,

            // Relationship tables
            'business_category' => BusinessCategoryResource::make(
                $this->whenLoaded('businessCategory')
            ),
            'jobs' => JobListingResource::make(
                $this->whenLoaded('jobListings')
            ),
        ];
    }
}
