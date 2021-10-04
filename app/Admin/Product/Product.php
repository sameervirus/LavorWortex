<?php

namespace App\Admin\Product;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    use HasMediaTrait;

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
              ->width(248)
              ->height(217);
    }

    public $timestamps = false;

    //
    protected $fillable = [
        'model','model_ar','category','category_ar','features','features_ar','technical_data','technical_data_ar','accessories','accessories_ar', 'optional', 'optional_ar', 'data_sheet',
    ];
}
