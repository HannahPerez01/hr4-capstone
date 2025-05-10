<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuccessionPlanningRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'requestor_id',
        'status',
        'job_position_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requestor_id');
    }

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class, 'job_position_id');
    }
}
