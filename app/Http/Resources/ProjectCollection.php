<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCollection extends ResourceCollection
{
    protected $badge;

    public function __construct($resource, $badge)
    {
        parent::__construct($resource);
        $this->badge = $badge;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        // Ensure the collection is not null
        $collection = $this->collection ?? collect();

        return [
            'count' => $collection->count(),
            'data' => $collection->map(function ($project) {
                return array_merge(
                    (new ProjectResource($project))->toArray(request()),
                    ['badge' => $this->badge]
                );
            })->all(),
        ];
    }
}
