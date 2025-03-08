<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift_and_schedule extends Model
{
 protected $table="hr3_shift_and_scheduling";

    use HasFactory;
      protected $fillable = [
        'employee_id',
        'shift_start',
        'shift_end',
        'shift_type',
        'shift_date',
        
    ];
}