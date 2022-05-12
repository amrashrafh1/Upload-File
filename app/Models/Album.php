<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class Album extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = ['name', 'cover_image', 'user_id'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(350)
              ->height(400)
              ->sharpen(10);
    }
}
