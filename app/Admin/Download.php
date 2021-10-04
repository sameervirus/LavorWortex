<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Download extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'type','name','name_ar','description','description_ar','link','sort_order',
    ];

    public function registerMediaCollections()
	{
	    $this
	        ->addMediaCollection('download_img')
	        ->singleFile();
	    $this
	        ->addMediaCollection('download_file')
	        ->singleFile();
	}
}
