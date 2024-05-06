<?php

namespace App\Models;

use Faker\Documentor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'alt_images' => 'array',
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function plans(): HasMany
    {
        return $this->hasMany(ProjectPlan::class);
    }

    public function logo(): BelongsTo
    {
        return $this->belongsTo(Logo::class);
    }

    protected static function booted()
    {
        self::deleting(function (Project $project) {

            Storage::disk('public')->delete($project->main_image);

            Storage::disk('public')->delete($project->brochure);

            foreach ($project->alt_images as $altImage) {
                Storage::disk('public')->delete($altImage);
            }

            $project->plans->each(function ($projectPlan) {
                Storage::disk('public')->delete($projectPlan->image);
            });
        });

        self::updated(function (Project $project) {

            if ($project->isDirty('main_image')) {
                $oldMainImage = $project->getOriginal('main_image');

                Storage::disk('public')->delete($oldMainImage);
            }

            if ($project->isDirty('brochure')) {
                $oldbrochure = $project->getOriginal('brochure');

                Storage::disk('public')->delete($oldbrochure);
            }

            if ($project->isDirty('alt_images')) {
                $oldAltImages = $project->getOriginal('alt_images');
                $newAltImages = $project->getAttribute('alt_images');

                $imagesToDelete = array_diff($oldAltImages, $newAltImages);

                foreach ($imagesToDelete as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
        });
    }
}
