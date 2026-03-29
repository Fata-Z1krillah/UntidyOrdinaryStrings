<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'title', 'description', 'duration_minutes',
        'max_attempts', 'available_from', 'available_until',
    ];

    protected function casts(): array
    {
        return [
            'available_from' => 'datetime',
            'available_until' => 'datetime',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('order');
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}
