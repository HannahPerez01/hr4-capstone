<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applicant extends Model
{
    use HasFactory;

    protected $table = "core1_employee";


    protected $fillable = [
        'employee_id',
        'employee_code',
        'firstname',
        'middlename',
        'lastname',
        'position',
        'trainee_fee',
        'contact',
        'email',
        'description',
        'image',
        'type',
    ];
}
