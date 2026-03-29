<x-app-layout>
@section('title', $course->title)
<div class="py-4">
    <div class="mb-4">
        <a href="{{ route('peserta.dashboard') }}" class="text-xs text-primary hover:underline flex items-center gap-1 mb-1">← Dashboard</a>
        <h2 class="text-lg font-bold text-gray-900">{{ $course->title }}</h2>
        <p class="text-xs text-gray-500">Pengajar: {{ $course->teacher->name }}</p>
    </div>

    <!-- Announcements -->
    @if($course->announcements->count() > 0)
    <div class="bg-amber-50 border border-amber-100 rounded-xl p-4 mb-4">
        <div class="font-semibold text-amber-900 text-sm mb-2">📢 Pengumuman Kelas</div>
        @foreach($course->announcements->take(3) as $ann)
        <div class="mb-2 last:mb-0">
            <div class="text-sm font-medium text-amber-900">{{ $ann->title }}</div>
            <p class="text-xs text-amber-700">{{ Str::limit($ann->content, 150) }}</p>
            <div class="text-xs text-amber-500 mt-0.5">{{ $ann->created_at->diffForHumans() }}</div>
        </div>
        @endforeach
    </div>
    @endif

    <div x-data="{ tab: 'materi' }" class="space-y-4">
        <div class="flex gap-1 bg-gray-100 rounded-lg p-1 text-sm w-fit">
            @foreach(['materi' => '📚 Materi', 'tugas' => '📝 Tugas', 'quiz' => '🧠 Quiz'] as $t => $label)
            <button @click="tab = '{{ $t }}'" :class="tab === '{{ $t }}' ? 'bg-white shadow text-primary' : 'text-gray-600'" class="px-3 py-1.5 rounded-md transition-all font-medium">{{ $label }}</button>
            @endforeach
        </div>

        <!-- Materi -->
        <div x-show="tab === 'materi'">
            <div class="space-y-2">
                @forelse($course->materials as $material)
                @php $done = isset($progress['App\\Models\\Material_' . $material->id]); @endphp
                <div class="bg-white rounded-lg border border-gray-100 p-4 flex items-center gap-4">
                    <span class="text-2xl">{{ $material->type === 'pdf' ? '📄' : ($material->type === 'video' ? '🎬' : ($material->type === 'audio' ? '🎵' : '🔗')) }}</span>
                    <div class="flex-1">
                        <div class="font-medium text-sm text-gray-900">{{ $material->title }}</div>
                        @if($material->description)<p class="text-xs text-gray-500 mt-0.5">{{ $material->description }}</p>@endif
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        @if($material->file_path || $material->external_url)
                        <a href="{{ $material->file_url }}" target="_blank" class="text-xs px-3 py-1.5 bg-primary text-white rounded-lg hover:bg-primary-dark">Buka</a>
                        @endif
                        @if(!$done)
                        <form method="POST" action="{{ route('peserta.materials.done', [$course, $material->id]) }}">
                            @csrf
                            <button type="submit" class="text-xs px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">Tandai Selesai</button>
                        </form>
                        @else
                        <span class="text-xs px-3 py-1.5 bg-green-50 text-green-600 rounded-lg">✓ Selesai</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400 bg-white rounded-lg border border-gray-100">Belum ada materi.</div>
                @endforelse
            </div>
        </div>

        <!-- Tugas -->
        <div x-show="tab === 'tugas'" x-cloak>
            <div class="space-y-3">
                @forelse($course->assignments as $assignment)
                @php
                    $submission = auth()->user()->submissions()->where('assignment_id', $assignment->id)->first();
                @endphp
                <div class="bg-white rounded-lg border border-gray-100 p-4">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <div class="font-medium text-sm text-gray-900">{{ $assignment->title }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">Deadline: {{ $assignment->deadline->format('d M Y H:i') }}</div>
                        </div>
                        @if($submission)
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $submission->score !== null ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $submission->score !== null ? 'Nilai: ' . $submission->score : 'Menunggu Nilai' }}
                        </span>
                        @elseif($assignment->isOverdue())
                        <span class="text-xs px-2 py-0.5 rounded-full bg-red-100 text-red-600">Terlambat</span>
                        @endif
                    </div>
                    @if($assignment->description)
                    <p class="text-xs text-gray-600 mb-3">{{ $assignment->description }}</p>
                    @endif
                    @if(!$submission && !$assignment->isOverdue())
                    <form method="POST" action="{{ route('peserta.assignments.submit', [$course, $assignment]) }}" enctype="multipart/form-data" class="mt-3 space-y-2">
                        @csrf
                        @if($assignment->type === 'upload')
                        <input type="file" name="file" required class="w-full text-xs border border-gray-200 rounded px-2 py-1.5">
                        @elseif($assignment->type === 'essay')
                        <textarea name="essay_answer" rows="4" placeholder="Tuliskan jawaban essay di sini..." required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"></textarea>
                        @endif
                        <button type="submit" class="px-4 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark">Kumpulkan Tugas</button>
                    </form>
                    @elseif($submission)
                    <div class="mt-2 p-2 bg-gray-50 rounded text-xs text-gray-600">
                        <div>Dikumpulkan: {{ $submission->submitted_at?->format('d M Y H:i') }}</div>
                        @if($submission->feedback)<div class="mt-1">Umpan balik: {{ $submission->feedback }}</div>@endif
                    </div>
                    @endif
                </div>
                @empty
                <div class="text-center py-8 text-gray-400 bg-white rounded-lg border border-gray-100">Belum ada tugas.</div>
                @endforelse
            </div>
        </div>

        <!-- Quiz -->
        <div x-show="tab === 'quiz'" x-cloak>
            <div class="space-y-2">
                @forelse($course->quizzes as $quiz)
                @php
                    $attempts = auth()->user()->quizAttempts()->where('quiz_id', $quiz->id)->get();
                    $canAttempt = $attempts->count() < $quiz->max_attempts;
                    $bestScore = $attempts->where('status', 'completed')->max('score');
                @endphp
                <div class="bg-white rounded-lg border border-gray-100 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-medium text-sm text-gray-900">{{ $quiz->title }}</div>
                            <div class="text-xs text-gray-500">{{ $quiz->duration_minutes }} menit &bull; {{ $quiz->questions->count() }} soal &bull; Percobaan: {{ $attempts->count() }}/{{ $quiz->max_attempts }}</div>
                            @if($bestScore !== null)<div class="text-xs text-green-600 font-medium mt-0.5">Nilai terbaik: {{ number_format($bestScore, 1) }}</div>@endif
                        </div>
                        @if($canAttempt)
                        <a href="{{ route('peserta.quizzes.start', [$course, $quiz]) }}" class="px-3 py-1.5 bg-primary text-white text-xs rounded-lg hover:bg-primary-dark">Mulai Quiz</a>
                        @else
                        <span class="text-xs px-2 py-1 bg-gray-100 text-gray-500 rounded-lg">Selesai</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400 bg-white rounded-lg border border-gray-100">Belum ada quiz.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</x-app-layout>
