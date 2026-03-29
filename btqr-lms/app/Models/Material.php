<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id', 'title', 'description', 'file_path', 'type', 'external_url', 'order',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function progress()
    {
        return $this->morphMany(Progress::class, 'trackable');
    }

    public function getFileUrlAttribute(): ?string
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return $this->external_url;
    }
}
