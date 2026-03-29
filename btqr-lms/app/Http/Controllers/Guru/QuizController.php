<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function create(Course $course)
    {
        return view('guru.quizzes.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'max_attempts' => 'required|integer|min:1',
            'available_from' => 'nullable|date',
            'available_until' => 'nullable|date|after:available_from',
        ]);
        $course->quizzes()->create($validated);
        return redirect()->route('guru.courses.show', $course)->with('success', 'Quiz berhasil dibuat.');
    }

    public function show(Course $course, Quiz $quiz)
    {
        $quiz->load(['questions.answers', 'attempts.student']);
        return view('guru.quizzes.show', compact('course', 'quiz'));
    }

    public function addQuestion(Request $request, Course $course, Quiz $quiz)
    {
        $validated = $request->validate([
            'question' => 'required|string',
            'type' => 'required|in:multiple_choice,essay',
            'points' => 'required|integer|min:1',
            'answers' => 'required_if:type,multiple_choice|array',
            'answers.*.text' => 'required_if:type,multiple_choice|string',
            'answers.*.is_correct' => 'boolean',
        ]);

        $question = $quiz->questions()->create([
            'question' => $validated['question'],
            'type' => $validated['type'],
            'points' => $validated['points'],
            'order' => $quiz->questions()->count() + 1,
        ]);

        if ($validated['type'] === 'multiple_choice' && isset($validated['answers'])) {
            foreach ($validated['answers'] as $i => $answer) {
                $question->answers()->create([
                    'answer_text' => $answer['text'],
                    'is_correct' => isset($answer['is_correct']) && $answer['is_correct'],
                    'order' => $i + 1,
                ]);
            }
        }

        return back()->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function destroy(Course $course, Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('guru.courses.show', $course)->with('success', 'Quiz berhasil dihapus.');
    }
}
