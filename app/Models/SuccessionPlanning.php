<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuccessionPlanning extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'current_position',
        'potential_successor',
        'development_needs',
        'readiness_level',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
