<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->courses()->withCount('students', 'materials', 'assignments')->get();
        return view('guru.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        abort_unless($course->teacher_id === Auth::id(), 403, 'Anda tidak memiliki akses ke kelas ini.');
        $course->load(['materials', 'assignments.submissions', 'quizzes', 'students', 'announcements']);
        return view('guru.courses.show', compact('course'));
    }
}
