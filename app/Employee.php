<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     protected $fillable = [
        'name', 'email', 'phone', 'address', 'experiance', 'nid_no', 'photo', 'salary', 'vacation', 'city'
    ];
}
