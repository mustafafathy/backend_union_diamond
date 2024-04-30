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
            'id' => $this->id,
            'name' => $this->when($this->name, $this->name),
            'type' => $this->when($this->type, $this->type),
            'description' => $this->when($this->description, $this->description),
            'area' => $this->when($this->area, $this->area),
            'units_no' => $this->when($this->units_no, $this->units_no),
            'brochure' => $this->when($this->brochure, asset('storage/' . $this->brochure)),
            'is_featured' => $this->when($this->is_featured, $this->is_featured),
            'main_image' => $this->when($this->main_image, asset('storage/' . $this->main_image)),
            'alt_images' => $this->when(isset($this->alt_images), $this->generateAltImageUrls()),
            'video' => $this->when($this->video, $this->video),
            'latitude' => $this->when($this->latitude, $this->latitude),
            'longitude' => $this->when($this->longitude, $this->longitude),
            'plans' => ProjectPlanResource::collection($this->whenLoaded('plans')),
            'features' => FeatureResource::collection($this->whenLoaded('features')),
        ];
    }

    protected function generateAltImageUrls()
    {
        $altImageUrls = [];
        foreach ($this->alt_images as $altImage) {
            $altImageUrls[] = asset('storage/' . $altImage);
        }
        return $altImageUrls;
    }
}
