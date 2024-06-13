<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebsiteDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'projects_count' => $this->when($this->projects_count, $this->projects_count),
            'units_count' => $this->when($this->units_count, $this->units_count),
            'res_num1' => $this->when($this->res_num1, $this->res_num1),
            'res_num2' => $this->when($this->res_num2, $this->res_num2),
            'whats_app_num' => $this->when($this->whats_app_num, $this->whats_app_num),
            'instagram_link' => $this->when($this->instagram_link, $this->instagram_link),
            'email' => $this->when($this->email, $this->email),
            'footer_num1' => $this->when($this->footer_num1, $this->footer_num1),
            'footer_num2' => $this->when($this->footer_num2, $this->footer_num2),
            'latitude' => $this->when($this->latitude, $this->latitude),
            'longitude' => $this->when($this->longitude, $this->longitude),
            'image' => $this->when($this->logos, $this->logos ? $this->generateLogosUrls() : ''),
            'who_image' => $this->when($this->who_image, asset('storage/' . $this->who_image)),
            'projects_image' => $this->when($this->projects_image, asset('storage/' . $this->projects_image)),
            'stages_image' => $this->when($this->stages_image, asset('storage/' . $this->stages_image)),

        ];
    }

    protected function generateLogosUrls()
    {
        $logosUrls = [];
        foreach ($this->logos as $logo) {
            $logosUrls[] = asset('storage/' . $logo);
        }
        return $logosUrls;
    }
}
