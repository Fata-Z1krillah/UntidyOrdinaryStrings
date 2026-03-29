<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'answer_text', 'is_correct', 'order'];

    protected function casts(): array
    {
        return ['is_correct' => 'boolean'];
    }

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
