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
        ];
    }
}
