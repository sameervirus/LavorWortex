<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    
    protected $fillable = [
        'name','city', 'address', 'phone', 'location',
        'name_ar','city_ar', 'address_ar', 'sort_order'
    ];

}

