<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class summarytable extends Model
{
    

     protected $table="hr4_summary_table";

    use HasFactory;
      protected $fillable = [
      
    'summary_id',
    'position_id',
    'basic_pay',
    'restday',
    'regularday',
    'allowance',
    'bonuses',
    'fringe_benefit',
    'totalcompensation',
        
    ];
}
