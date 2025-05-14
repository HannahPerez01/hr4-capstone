<?php

namespace App\Models;

use App\Models\Examination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
  use HasFactory;

  protected $fillable = [
    'examination_id',
    'user_id',
    'questions',
    'options',
    'correct_answer',
  ];

  protected $casts = [
    'options' => 'json'
  ];

  public function examination(): BelongsTo
  {
    return $this->belongsTo(Examination::class);
  }
}
