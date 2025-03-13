<?php

namespace App\Models;

use App\Models\JobPosition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompensationPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_position_id',
        'extra_field',
    ];

    protected $casts = [
        'extra_field' => 'array'
    ];

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
    }
}
