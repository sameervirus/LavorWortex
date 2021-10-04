<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{

	use HasMediaTrait;

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(248)
              ->height(217);
    }
    
    protected $fillable = [
        'title', 'slug', 'body', 'title_ar', 'body_ar', 'sort_order',
    ];

}
