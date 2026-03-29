<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('teacher')->withCount('students')->latest()->paginate(20);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $teachers = User::where('role', 'guru')->get();
        return view('admin.courses.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id',
            'status' => 'in:active,inactive',
        ]);
        Course::create($validated);
        return redirect()->route('admin.courses.index')->with('success', 'Kelas berhasil dibuat.');
    }

    public function edit(Course $course)
    {
        $teachers = User::where('role', 'guru')->get();
        return view('admin.courses.edit', compact('course', 'teachers'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:users,id',
            'status' => 'in:active,inactive',
        ]);
        $course->update($validated);
        return redirect()->route('admin.courses.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Kelas berhasil dihapus.');
    }

    public function enrollStudents(Request $request, Course $course)
    {
        $validated = $request->validate(['student_ids' => 'required|array']);
        $course->students()->syncWithoutDetaching($validated['student_ids']);
        return back()->with('success', 'Peserta berhasil ditambahkan ke kelas.');
    }
}
