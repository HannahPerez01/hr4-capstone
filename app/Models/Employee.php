<?php

namespace App\Models;

use App\Models\Payroll;
use App\Models\JobPosition;
use App\Models\Compensation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_code',
        'name',
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

    public function compensation(): HasMany
    {
        return $this->hasMany(Compensation::class);
    }

    public function payrolls(): HasMany
    {
        return $this->hasMany(Payroll::class);
    }
}
