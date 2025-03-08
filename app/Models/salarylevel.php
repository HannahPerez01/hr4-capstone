<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salarylevel extends Model
{
   
 protected $table="hr4_salarylevel";

    use HasFactory;
      protected $fillable = [
        'levelname',
        'salarylevel_id',
        'position_id',
        'step1',
        'step2',
        'step3',
        'step4',
        'step5',
        'step6',
        'step7',
        'step8',
        
    ];

}
