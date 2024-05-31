<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WebsiteData extends Model
{
    use HasFactory;

    protected $casts = [
        'logos' => 'array',
    ];

    protected static function booted()
    {
        self::updated(function (WebsiteData $websiteData) {
            if ($websiteData->isDirty('logos')) {
                $oldLogos = $websiteData->getOriginal('logos');
                $newLogos = $websiteData->getAttribute('logos');

                $imagesToDelete = array_diff($oldLogos, $newLogos);

                foreach ($imagesToDelete as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
        });
    }
}
