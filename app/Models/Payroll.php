<?php
namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'from',
        'to',
        'basic_salary_hours',
        'basic_salary_amount',
        'reg_ot_hours',
        'reg_ot_amount',
        'rd_ot_hours',
        'rd_ot_amount',
        'pag_ibig',
        'sss',
        'philhealth',
        'total_deductions',
        'total_earnings',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
