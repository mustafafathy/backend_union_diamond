<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'type' => $this->resource->type,
            'description' => $this->resource->description,
            'area' => $this->resource->area ,
            'units_no' => $this->resource->units_no,
            'is_featured' => $this->resource->is_featured,
            'plans' => ProjectPlanResource::collection($this->whenLoaded('plans')),
            'features' => FeatureResource::collection($this->whenLoaded('features')),
        ];
    }
}
