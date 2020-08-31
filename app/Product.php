<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'cat_id', 'product_image', 'product_route', 'product_row', 'buying_price', 'selling_price'
    ];
}
