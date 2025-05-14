<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Examination extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'title',
      'type',
      'status',
    ];

    public function questions(): HasMany
    {
      return $this->hasMany(Question::class);
    }
}
