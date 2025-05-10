<?php

namespace App\Models;

use App\Models\Payroll;
use App\Models\JobPosition;
use App\Models\Compensation;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Employee extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'employee_code',
        'name',
        'generate_code',
        'gender',
        'civil_status',
        'age',
        'email',
        'present_address',
        'job_position_id',
        'department',
        'employment_type',
        'date_hired',
        'status',
        'resigned_at'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('employee_profile_attachments');
    }

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
