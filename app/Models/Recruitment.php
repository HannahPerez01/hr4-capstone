<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $table    = "job_";
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
