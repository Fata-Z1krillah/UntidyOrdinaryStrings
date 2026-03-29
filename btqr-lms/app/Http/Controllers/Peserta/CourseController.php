<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Progress;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        $user = Auth::user();
        abort_unless($course->students()->where('student_id', $user->id)->exists(), 403, 'Anda tidak terdaftar di kelas ini.');
        $course->load(['materials', 'assignments', 'quizzes', 'announcements.author', 'teacher']);
        $progress = Progress::where('student_id', $user->id)->get()->keyBy(fn($p) => $p->trackable_type . '_' . $p->trackable_id);
        return view('peserta.courses.show', compact('course', 'progress'));
    }

    public function submitAssignment(Request $request, Course $course, Assignment $assignment)
    {
        $user = Auth::user();
        $existing = Submission::where('assignment_id', $assignment->id)->where('student_id', $user->id)->first();
        if ($existing) {
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini.');
        }

        $validated = $request->validate([
            'file' => 'nullable|file|max:20480',
            'essay_answer' => 'nullable|string',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
        }

        Submission::create([
            'assignment_id' => $assignment->id,
            'student_id' => $user->id,
            'file_path' => $filePath,
            'essay_answer' => $validated['essay_answer'] ?? null,
            'status' => $assignment->isOverdue() ? 'late' : 'submitted',
            'submitted_at' => now(),
        ]);

        return back()->with('success', 'Tugas berhasil dikumpulkan.');
    }

    public function markMaterialDone(Course $course, $materialId)
    {
        $user = Auth::user();
        Progress::firstOrCreate([
            'student_id' => $user->id,
            'trackable_type' => 'App\Models\Material',
            'trackable_id' => $materialId,
        ], ['is_completed' => true, 'completed_at' => now()]);
        return back()->with('success', 'Materi ditandai selesai.');
    }

    public function startQuiz(Course $course, Quiz $quiz)
    {
        $user = Auth::user();
        $attempts = QuizAttempt::where('quiz_id', $quiz->id)->where('student_id', $user->id)->count();
        if ($attempts >= $quiz->max_attempts) {
            return back()->with('error', 'Anda telah mencapai batas percobaan quiz.');
        }
        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'student_id' => $user->id,
            'started_at' => now(),
            'status' => 'in_progress',
        ]);
        $quiz->load('questions.answers');
        return view('peserta.quizzes.attempt', compact('course', 'quiz', 'attempt'));
    }

    public function submitQuiz(Request $request, Course $course, Quiz $quiz, QuizAttempt $attempt)
    {
        $answers = $request->input('answers', []);
        $score = 0;
        $totalPoints = 0;
        foreach ($quiz->questions as $question) {
            $totalPoints += $question->points;
            if ($question->type === 'multiple_choice' && isset($answers[$question->id])) {
                $correct = $question->answers()->where('is_correct', true)->first();
                if ($correct && $answers[$question->id] == $correct->id) {
                    $score += $question->points;
                }
            }
        }
        $finalScore = $totalPoints > 0 ? ($score / $totalPoints) * 100 : 0;
        $attempt->update([
            'answers' => $answers,
            'score' => $finalScore,
            'finished_at' => now(),
            'status' => 'completed',
        ]);
        return redirect()->route('peserta.courses.show', $course)->with('success', "Quiz selesai! Nilai Anda: {$finalScore}");
    }
}
