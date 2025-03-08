<?php

namespace App\Models;

use App\Models\JobPosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'hr1_employee_info';
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'employee_code',
        'employee_id',
        'employee_name',
        'generate_code',
        'gender',
        'job_position_id',
        'department',
        'employment_type',
        'date_hired',
        'status',
    ];

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }
}
