<x-app-layout>
@section('title', $assignment->title)
<div class="py-4">
    <a href="{{ route('guru.courses.show', $course) }}" class="text-sm text-primary hover:underline flex items-center gap-1 mb-4">← Kembali</a>
    <div class="flex items-center justify-between mb-4">
        <div>
            <h2 class="text-lg font-bold text-gray-900">{{ $assignment->title }}</h2>
            <p class="text-xs text-gray-500">Deadline: {{ $assignment->deadline->format('d M Y H:i') }} &bull; Max Nilai: {{ $assignment->max_score }}</p>
        </div>
        <a href="{{ route('guru.assignments.export', [$course, $assignment]) }}" class="px-3 py-1.5 bg-green-600 text-white text-xs rounded-lg hover:bg-green-700">Export CSV</a>
    </div>

    @if($assignment->description)
    <div class="bg-blue-50 rounded-lg p-4 mb-4 text-sm text-gray-700">{{ $assignment->description }}</div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-5 py-3 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">Pengumpulan ({{ $submissions->count() }})</h3>
        </div>
        @forelse($submissions as $submission)
        <div class="px-5 py-4 border-b border-gray-50 last:border-0">
            <div class="flex items-start gap-4">
                <img src="{{ $submission->student->avatar_url }}" class="w-8 h-8 rounded-full flex-shrink-0" alt="">
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div class="font-medium text-sm text-gray-900">{{ $submission->student->name }}</div>
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $submission->status === 'graded' ? 'bg-green-100 text-green-700' : ($submission->status === 'late' ? 'bg-red-100 text-red-600' : 'bg-yellow-100 text-yellow-700') }}">{{ ucfirst($submission->status) }}</span>
                    </div>
                    @if($submission->file_path)
                    <a href="{{ $submission->file_url }}" target="_blank" class="text-xs text-primary hover:underline">📎 Lihat File</a>
                    @endif
                    @if($submission->essay_answer)
                    <p class="text-xs text-gray-600 mt-1 p-2 bg-gray-50 rounded">{{ Str::limit($submission->essay_answer, 200) }}</p>
                    @endif
                    <div class="text-xs text-gray-400 mt-1">Dikumpulkan: {{ $submission->submitted_at?->format('d M Y H:i') }}</div>

                    <!-- Grade Form -->
                    <form method="POST" action="{{ route('guru.assignments.grade', [$course, $assignment, $submission]) }}" class="mt-3 flex gap-2 items-end">
                        @csrf
                        <div>
                            <label class="block text-xs text-gray-500 mb-0.5">Nilai (0-{{ $assignment->max_score }})</label>
                            <input type="number" name="score" value="{{ $submission->score }}" min="0" max="{{ $assignment->max_score }}" step="0.1" class="w-20 border border-gray-200 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-primary/30">
                        </div>
                        <div class="flex-1">
                            <label class="block text-xs text-gray-500 mb-0.5">Umpan Balik</label>
                            <input type="text" name="feedback" value="{{ $submission->feedback }}" placeholder="Tuliskan umpan balik..." class="w-full border border-gray-200 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-primary/30">
                        </div>
                        <button type="submit" class="px-3 py-1.5 bg-primary text-white text-xs rounded hover:bg-primary-dark flex-shrink-0">Simpan Nilai</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-10 text-gray-400 text-sm">Belum ada santri yang mengumpulkan tugas ini.</div>
        @endforelse
    </div>
</div>
</x-app-layout>
