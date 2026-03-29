<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_peserta' => User::where('role', 'peserta')->count(),
            'total_guru' => User::where('role', 'guru')->count(),
            'total_courses' => Course::count(),
            'total_submissions' => Submission::count(),
            'pending_grading' => Submission::whereNull('score')->count(),
        ];
        $recent_users = User::latest()->take(5)->get();
        $recent_courses = Course::with('teacher')->latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recent_users', 'recent_courses'));
    }
}
