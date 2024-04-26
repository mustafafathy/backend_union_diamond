<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProjectPlan extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected static function booted()
    {
        self::deleting(function (ProjectPlan $projectPlan) {

            Storage::disk('public')->delete($projectPlan->image);
        });

        self::updated(function (ProjectPlan $projectPlan) {

            if ($projectPlan->isDirty('image')) {
                $oldImage = $projectPlan->getOriginal('image');

                Storage::disk('public')->delete($oldImage);
            }
        });
    }
}
