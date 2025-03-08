<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
 protected $table="hr3_leave_management";

    use HasFactory;
      protected $fillable = [
        'employee_id',
        'employee_name',
        'start_date',
        'end_date',
        'date_request',
        'leave_type',
        'status',
        
    ];
}
