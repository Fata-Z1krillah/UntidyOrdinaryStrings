<x-app-layout>
@section('title', $quiz->title)
<div class="py-4">
    <a href="{{ route('guru.courses.show', $course) }}" class="text-sm text-primary hover:underline flex items-center gap-1 mb-4">← Kembali</a>
    <h2 class="text-lg font-bold text-gray-900 mb-1">{{ $quiz->title }}</h2>
    <p class="text-xs text-gray-500 mb-4">{{ $quiz->duration_minutes }} menit &bull; Maks {{ $quiz->max_attempts }} percobaan &bull; {{ $quiz->questions->count() }} pertanyaan</p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Add Question -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="font-semibold text-gray-900 mb-4">Tambah Pertanyaan</h3>
            <form method="POST" action="{{ route('guru.quizzes.questions.store', [$course, $quiz]) }}" x-data="{ type: 'multiple_choice' }">
                @csrf
                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Pertanyaan *</label>
                        <textarea name="question" rows="2" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Tipe</label>
                            <select name="type" x-model="type" class="w-full border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                                <option value="multiple_choice">Pilihan Ganda</option>
                                <option value="essay">Essay</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Poin</label>
                            <input type="number" name="points" value="1" min="1" class="w-full border border-gray-200 rounded-lg px-2 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                        </div>
                    </div>
                    <div x-show="type === 'multiple_choice'">
                        <label class="block text-xs font-medium text-gray-600 mb-2">Pilihan Jawaban</label>
                        @for($i = 0; $i < 4; $i++)
                        <div class="flex gap-2 mb-2">
                            <input type="text" name="answers[{{ $i }}][text]" placeholder="Pilihan {{ chr(65+$i) }}" class="flex-1 border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-primary/30">
                            <label class="flex items-center gap-1 text-xs text-gray-500 whitespace-nowrap">
                                <input type="checkbox" name="answers[{{ $i }}][is_correct]" value="1"> Benar
                            </label>
                        </div>
                        @endfor
                    </div>
                </div>
                <button type="submit" class="mt-4 w-full py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark">Tambah Pertanyaan</button>
            </form>
        </div>

        <!-- Questions List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="font-semibold text-gray-900 mb-4">Daftar Pertanyaan ({{ $quiz->questions->count() }})</h3>
            <div class="space-y-3">
                @forelse($quiz->questions as $i => $question)
                <div class="border border-gray-100 rounded-lg p-3">
                    <div class="flex items-start gap-2">
                        <span class="text-xs font-bold text-primary mt-0.5">{{ $i+1 }}.</span>
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">{{ $question->question }}</p>
                            <div class="flex gap-2 mt-1">
                                <span class="text-xs px-1.5 py-0.5 bg-blue-50 text-blue-600 rounded">{{ $question->type === 'multiple_choice' ? 'Pilihan Ganda' : 'Essay' }}</span>
                                <span class="text-xs px-1.5 py-0.5 bg-yellow-50 text-yellow-700 rounded">{{ $question->points }} poin</span>
                            </div>
                            @if($question->type === 'multiple_choice')
                            <ul class="mt-2 space-y-0.5">
                                @foreach($question->answers as $answer)
                                <li class="text-xs {{ $answer->is_correct ? 'text-green-600 font-medium' : 'text-gray-500' }}">
                                    {{ $answer->is_correct ? '✓' : '○' }} {{ $answer->answer_text }}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center py-6 text-gray-400 text-sm">Belum ada pertanyaan.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Attempts -->
    @if($quiz->attempts->count() > 0)
    <div class="mt-6 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-5 py-3 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Hasil Quiz Santri ({{ $quiz->attempts->count() }})</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50"><tr>
                    <th class="text-left px-5 py-2 text-xs text-gray-500">Santri</th>
                    <th class="text-left px-5 py-2 text-xs text-gray-500">Nilai</th>
                    <th class="text-left px-5 py-2 text-xs text-gray-500">Status</th>
                    <th class="text-left px-5 py-2 text-xs text-gray-500">Waktu</th>
                </tr></thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($quiz->attempts as $attempt)
                    <tr>
                        <td class="px-5 py-2 font-medium text-gray-900">{{ $attempt->student->name }}</td>
                        <td class="px-5 py-2 font-bold {{ $attempt->score >= 70 ? 'text-green-600' : 'text-red-500' }}">{{ $attempt->score ? number_format($attempt->score, 1) : '-' }}</td>
                        <td class="px-5 py-2"><span class="text-xs px-1.5 py-0.5 rounded {{ $attempt->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ $attempt->status === 'completed' ? 'Selesai' : 'Berlangsung' }}</span></td>
                        <td class="px-5 py-2 text-gray-500 text-xs">{{ $attempt->finished_at?->format('d M Y H:i') ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
</x-app-layout>
