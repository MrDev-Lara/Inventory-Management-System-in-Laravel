<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'phone', 'photo', 'shop_name', 'shop_location', 'bank_account_name', 'account_number'
    ];
}
