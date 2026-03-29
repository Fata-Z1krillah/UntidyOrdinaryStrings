<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar',
        'tanggal_lahir', 'google_id', 'is_active',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'tanggal_lahir' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isGuru(): bool { return $this->role === 'guru'; }
    public function isPeserta(): bool { return $this->role === 'peserta'; }

    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'student_id');
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollments', 'student_id', 'course_id')
            ->withTimestamps();
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'student_id');
    }

    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class, 'student_id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'student_id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'student_id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }
        $name = urlencode($this->name);
        return "https://ui-avatars.com/api/?name={$name}&background=1a6b3a&color=fff";
    }
}
