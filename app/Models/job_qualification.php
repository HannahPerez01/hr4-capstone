<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_qualification extends Model
{
    use HasFactory;

     protected $table="hr2_job_qualification";

    use HasFactory;
      protected $fillable = [
        'job_id',
        'job_request_id',
        'description',
        'status',
    ];
}
