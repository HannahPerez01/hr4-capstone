<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class deduction extends Model
{
    use HasFactory;


     protected $table="hr4_deduction";
      protected $fillable = [
        'employee_id',
        'sss',
        'pagibig',
        'philhealth',
        
    ];
}
