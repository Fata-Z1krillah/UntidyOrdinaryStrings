<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = $user->courses()->withCount('students', 'materials', 'assignments')->get();
        $pending_submissions = Submission::whereHas('assignment.course', fn($q) => $q->where('teacher_id', $user->id))
            ->whereNull('score')->count();
        return view('guru.dashboard', compact('courses', 'pending_submissions'));
    }
}
