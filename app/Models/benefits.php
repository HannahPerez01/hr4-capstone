<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class benefits extends Model
{
   
     protected $table="hr4_benefits";

    use HasFactory;
      protected $fillable = [
      
    'benefits_id',
    'position_id',
    'component',
    'detail',
        
    ];
}
