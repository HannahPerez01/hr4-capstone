<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruite extends Model
{
    use HasFactory;

         protected $table="hr4_recruitment";
      protected $fillable = [
        'recruitment_id',
        'jobrole',
        'department',
        'status',
          'salary',
            'time',
        'description',
        
    ];
}
