<?php

namespace App\Admin\Pages;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    
    protected $fillable = [
        'page','content', 'content_ar'
    ];

}

