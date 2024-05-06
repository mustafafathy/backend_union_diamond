<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Logo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected static function booted()
    {
        self::deleting(function (Logo $logo) {

            Storage::disk('public')->delete($logo->image);
        });

        self::updated(function (Logo $logo) {

            if ($logo->isDirty('image')) {
                $oldImage = $logo->getOriginal('image');

                Storage::disk('public')->delete($oldImage);
            }
        });
    }
}
