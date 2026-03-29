<x-app-layout>
@section('title', 'Quiz: ' . $quiz->title)
<div class="py-4 max-w-2xl">
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-4 flex items-center justify-between">
        <div>
            <div class="font-semibold text-amber-900">{{ $quiz->title }}</div>
            <div class="text-xs text-amber-700">Waktu: {{ $quiz->duration_minutes }} menit</div>
        </div>
        <div class="text-2xl font-bold text-amber-900" id="timer">{{ $quiz->duration_minutes }}:00</div>
    </div>

    <form method="POST" action="{{ route('peserta.quizzes.submit', [$course, $quiz, $attempt]) }}" id="quiz-form">
        @csrf
        <div class="space-y-4">
            @foreach($quiz->questions as $i => $question)
            <div class="bg-white rounded-xl border border-gray-100 p-5">
                <div class="flex items-start gap-3 mb-4">
                    <span class="bg-primary text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">{{ $i+1 }}</span>
                    <p class="text-sm font-medium text-gray-900 leading-relaxed">{{ $question->question }}</p>
                </div>
                @if($question->type === 'multiple_choice')
                <div class="space-y-2 ml-9">
                    @foreach($question->answers as $answer)
                    <label class="flex items-center gap-3 cursor-pointer p-2 rounded-lg hover:bg-gray-50">
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" class="text-primary">
                        <span class="text-sm text-gray-700">{{ $answer->answer_text }}</span>
                    </label>
                    @endforeach
                </div>
                @else
                <div class="ml-9">
                    <textarea name="answers[{{ $question->id }}]" rows="4" placeholder="Tulis jawaban Anda..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"></textarea>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <div class="mt-6">
            <button type="submit" onclick="return confirm('Yakin ingin mengumpulkan quiz sekarang?')" class="w-full py-3 bg-primary text-white font-semibold rounded-xl hover:bg-primary-dark transition-colors">Kumpulkan Quiz</button>
        </div>
    </form>
</div>
<script>
let seconds = {{ $quiz->duration_minutes * 60 }};
const timer = document.getElementById('timer');
const interval = setInterval(() => {
    seconds--;
    const m = Math.floor(seconds / 60).toString().padStart(2, '0');
    const s = (seconds % 60).toString().padStart(2, '0');
    timer.textContent = m + ':' + s;
    if(seconds <= 0) { clearInterval(interval); document.getElementById('quiz-form').submit(); }
}, 1000);
</script>
</x-app-layout>
