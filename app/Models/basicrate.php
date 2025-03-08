<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class basicrate extends Model
{
    use HasFactory;

    protected $table = 'hr4_basicrate'; 

      protected $fillable = [ 'position_id', 
      'basic_pay_range',
       'daily_rate', 
       'hourly_rate',];

}
