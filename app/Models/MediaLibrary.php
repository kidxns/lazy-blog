<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaLibrary extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'media_libraries';

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blog')->
            registerMediaConversions(function (Media $media) {
            $this
                ->addMediaConversion('thumb')
                ->width(150)
                ->height(150);

            $this->addMediaConversion('square')
                ->width(412)
                ->height(412);
        });
    }
}
