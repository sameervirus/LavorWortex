<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Wproduct extends Model implements HasMedia
{

  use HasMediaTrait;

  protected $table = 'wproducts';

  public function registerMediaConversions(Media $media = null)
  {
      $this->addMediaConversion('small')
            ->width(290)
            ->height(232);
      $this->addMediaConversion('thumb')
            ->width(80)
            ->height(64);
  }
  
  protected $fillable = [
      'category', 'category_ar', 'slug', 'name', 'name_ar', 'details', 'details_ar', 'sort_order',
  ];

}
