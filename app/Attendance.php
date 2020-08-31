<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
      protected $fillable = [
        'employee_id', 'attend', 'attend_date', 'attend_year', 'edit_date'
    ];
}
