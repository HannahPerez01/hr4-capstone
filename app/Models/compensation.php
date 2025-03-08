<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compensation extends Model
{
    use HasFactory;

     protected $table="hr4_compensation";
      protected $fillable = [
        'employee_id',
        'project_name',
        'compensation_type',
        'amount',
        'status',
        
    ];
}
