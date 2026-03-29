<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id', 'student_id', 'answers', 'score', 'started_at', 'finished_at', 'status'];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'started_at' => 'datetime',
            'finished_at' => 'datetime',
        ];
    }

    public function quiz() { return $this->belongsTo(Quiz::class); }
    public function student() { return $this->belongsTo(User::class, 'student_id'); }
}
