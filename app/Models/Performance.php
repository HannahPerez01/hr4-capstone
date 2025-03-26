<?php
namespace App\Models;

use App\Models\Employee;
use App\Models\JobPosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Performance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'job_position_id',
        'department',
        'total_hours_work',
        'training',
        'performance_review',
        'last_review_date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }
}
