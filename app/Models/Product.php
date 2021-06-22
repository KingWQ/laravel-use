<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'is_on_sale',
        'pic_url',
        'price',
        'attr'
    ];

    protected $casts = [
        'attr'=>'array',
    ];
}
