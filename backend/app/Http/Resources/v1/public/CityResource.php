<?php

namespace App\Http\Resources\v1\public;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'overview' => $this->slug,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'active' => $this->active,
            // Relationship Table
            'province' => ProvinceResource::make($this->whenLoaded('province')),
            'jobs' => JobListingResource::collection($this->whenLoaded('jobListings')),
            'areas' => AreaResource::collection($this->whenLoaded('areas')),
        ];
    }
}
