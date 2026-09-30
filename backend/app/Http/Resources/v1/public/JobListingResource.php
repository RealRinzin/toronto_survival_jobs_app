<?php

namespace App\Http\Resources\v1\public;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'address' => $this->address,
            'location' => $this->location,
            'country' => $this->country,
            'salary' => $this->salary,
            'published' => $this->published,
            'apply_url' => $this->apply_url,
            'posted_date' => $this->posted_date,
            'due_date' => $this->due_date,
            'system_posted_date' => $this->system_posted_date,

            /* -------------------------------------------------------------
     | Relationships - Load
     |-------------------------------------------------------------*/
            'company' => CompanyResource::make(
                $this->whenLoaded('company')
            ),

        ];
    }
}
