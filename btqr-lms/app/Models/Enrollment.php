<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'student_id', 'enrolled_at', 'completed_at'];

    protected function casts(): array
    {
        return ['enrolled_at' => 'datetime', 'completed_at' => 'datetime'];
    }

    public function course() { return $this->belongsTo(Course::class); }
    public function student() { return $this->belongsTo(User::class, 'student_id'); }
}
