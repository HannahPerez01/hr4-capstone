<?php

namespace App\Models;

use App\Models\Applicant;
use App\Models\Examination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApplicantScore extends Model
{
    use HasFactory;

    protected $fillable = [
      'applicant_id',
      'employee_id',
      'examination_id',
      'score',
      'status',
      'duration',
    ];

    public function applicant(): BelongsTo
    {
      return $this->belongsTo(Applicant::class);
    }

    public function examination(): BelongsTo
    {
      return $this->belongsTo(Examination::class);
    }

    public function employee(): BelongsTo
    {
      return $this->belongsTo(Employee::class);
    }
}
