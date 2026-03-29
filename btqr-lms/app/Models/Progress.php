<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'trackable_type', 'trackable_id', 'is_completed', 'completed_at'];

    protected function casts(): array
    {
        return ['is_completed' => 'boolean', 'completed_at' => 'datetime'];
    }

    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function trackable() { return $this->morphTo(); }
}
