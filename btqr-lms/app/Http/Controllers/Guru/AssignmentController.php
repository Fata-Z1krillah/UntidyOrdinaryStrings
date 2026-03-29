<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function create(Course $course)
    {
        return view('guru.assignments.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'max_score' => 'required|integer|min:1|max:100',
            'type' => 'required|in:essay,upload,multiple_choice',
        ]);
        $course->assignments()->create($validated);
        return redirect()->route('guru.courses.show', $course)->with('success', 'Tugas berhasil dibuat.');
    }

    public function show(Course $course, Assignment $assignment)
    {
        $submissions = $assignment->submissions()->with('student')->latest()->get();
        return view('guru.assignments.show', compact('course', 'assignment', 'submissions'));
    }

    public function grade(Request $request, Course $course, Assignment $assignment, Submission $submission)
    {
        $validated = $request->validate([
            'score' => 'required|numeric|min:0|max:' . $assignment->max_score,
            'feedback' => 'nullable|string',
        ]);
        $submission->update([...$validated, 'status' => 'graded']);
        return back()->with('success', 'Nilai berhasil disimpan.');
    }

    public function destroy(Course $course, Assignment $assignment)
    {
        $assignment->delete();
        return redirect()->route('guru.courses.show', $course)->with('success', 'Tugas berhasil dihapus.');
    }

    public function exportNilai(Course $course, Assignment $assignment)
    {
        $submissions = $assignment->submissions()->with('student')->get();
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => "attachment; filename=nilai_{$assignment->id}.csv"];
        $callback = function() use ($submissions, $assignment) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Nama', 'Email', 'Nilai', 'Feedback', 'Waktu Submit']);
            foreach ($submissions as $s) {
                fputcsv($file, [$s->student->name, $s->student->email, $s->score, $s->feedback, $s->submitted_at]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
