<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = $user->enrolledCourses()->withCount('materials', 'assignments')->with('teacher')->get();
        $announcements = Announcement::where('is_global', true)
            ->orWhereIn('course_id', $user->enrolledCourses()->pluck('id'))
            ->with('author', 'course')->latest()->take(5)->get();
        $pending_assignments = 0;
        foreach ($courses as $course) {
            foreach ($course->assignments as $assignment) {
                $submitted = $user->submissions()->where('assignment_id', $assignment->id)->exists();
                if (!$submitted && !$assignment->isOverdue()) {
                    $pending_assignments++;
                }
            }
        }
        return view('peserta.dashboard', compact('courses', 'announcements', 'pending_assignments'));
    }
}
