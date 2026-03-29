<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'student_id', 'file_path', 'issued_at'];

    protected function casts(): array
    {
        return ['issued_at' => 'datetime'];
    }

    public function course() { return $this->belongsTo(Course::class); }
    public function student() { return $this->belongsTo(User::class, 'student_id'); }

    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }
}
