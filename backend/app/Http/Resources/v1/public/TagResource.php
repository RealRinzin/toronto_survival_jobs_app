<?php

namespace App\Http\Resources\v1\public;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            'active' => $this->active,
            // Count
            'job_listings_count' => $this->whenCounted('jobListings'),
            // Relationship
            'jobs' => JobListingResource::collection(
                $this->whenLoaded('jobListings')
            )
            // 'tags' => TagResource::collection($this->whenLoaded('tags')),

        ];
    }
}
