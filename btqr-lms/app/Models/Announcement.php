<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'title', 'content', 'is_global'];

    protected function casts(): array
    {
        return ['is_global' => 'boolean'];
    }

    public function author() { return $this->belongsTo(User::class, 'user_id'); }
    public function course() { return $this->belongsTo(Course::class); }
}
