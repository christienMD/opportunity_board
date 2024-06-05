<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OpportunityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'description' => $this->description,
            'img_url' => $this->img_url,
            'category' => $this->category,
            'created_at' => $this->created_at,
            'closing_date' => $this->closing_date,
            'user' => new UserResource($this->whenLoaded('company'))
        ];
    }
}
