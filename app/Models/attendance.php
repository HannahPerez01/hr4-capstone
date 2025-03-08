<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    use HasFactory;

     protected $table="hr3_attendance";

    use HasFactory;
      protected $fillable = [
        'employee_id',
        'employee_name',
        'time_in',
        'time_out',
        
    ];
}
