<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'employee_name',
        'claim_date',
        'claim_type',
        'amount',
        
    ];


}
