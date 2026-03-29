<x-app-layout>
@section('title', $course->title)
<div class="py-4">
    <div class="flex items-center justify-between mb-4">
        <div>
            <a href="{{ route('guru.courses.index') }}" class="text-xs text-primary hover:underline flex items-center gap-1 mb-1">← Kembali</a>
            <h2 class="text-lg font-bold text-gray-900">{{ $course->title }}</h2>
            <p class="text-xs text-gray-500">{{ $course->students->count() }} santri terdaftar</p>
        </div>
    </div>

    <!-- Tabs -->
    <div x-data="{ tab: 'materi' }" class="space-y-4">
        <div class="flex gap-1 bg-gray-100 rounded-lg p-1 text-sm w-fit">
            @foreach(['materi' => '📚 Materi', 'tugas' => '📝 Tugas', 'quiz' => '🧠 Quiz', 'pengumuman' => '📢 Pengumuman'] as $t => $label)
            <button @click="tab = '{{ $t }}'" :class="tab === '{{ $t }}' ? 'bg-white shadow text-primary' : 'text-gray-600'" class="px-3 py-1.5 rounded-md transition-all font-medium">{{ $label }}</button>
            @endforeach
        </div>

        <!-- Materi -->
        <div x-show="tab === 'materi'">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-gray-900">Daftar Materi</h3>
                <a href="{{ route('guru.materials.create', $course) }}" class="text-xs px-3 py-1.5 bg-primary text-white rounded-lg hover:bg-primary-dark">+ Tambah Materi</a>
            </div>
            <div class="space-y-2">
                @forelse($course->materials as $material)
                <div class="bg-white rounded-lg border border-gray-100 p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">{{ $material->type === 'pdf' ? '📄' : ($material->type === 'video' ? '🎬' : ($material->type === 'audio' ? '🎵' : '🔗')) }}</span>
                        <div>
                            <div class="font-medium text-sm text-gray-900">{{ $material->title }}</div>
                            <div class="text-xs text-gray-400">{{ strtoupper($material->type) }}</div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('guru.materials.edit', [$course, $material]) }}" class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100">Edit</a>
                        <form method="POST" action="{{ route('guru.materials.destroy', [$course, $material]) }}" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-xs px-2 py-1 bg-red-50 text-red-600 rounded hover:bg-red-100">Hapus</button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400 bg-white rounded-lg border border-gray-100">Belum ada materi. Tambahkan materi pertama.</div>
                @endforelse
            </div>
        </div>

        <!-- Tugas -->
        <div x-show="tab === 'tugas'" x-cloak>
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-gray-900">Daftar Tugas</h3>
                <a href="{{ route('guru.assignments.create', $course) }}" class="text-xs px-3 py-1.5 bg-primary text-white rounded-lg hover:bg-primary-dark">+ Tambah Tugas</a>
            </div>
            <div class="space-y-2">
                @forelse($course->assignments as $assignment)
                <div class="bg-white rounded-lg border border-gray-100 p-4">
                    <div class="flex items-center justify-between mb-2">
                        <div>
                            <div class="font-medium text-sm text-gray-900">{{ $assignment->title }}</div>
                            <div class="text-xs text-gray-500 mt-0.5">Deadline: {{ $assignment->deadline->format('d M Y H:i') }} &bull; Max: {{ $assignment->max_score }}</div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('guru.assignments.show', [$course, $assignment]) }}" class="text-xs px-2 py-1 bg-green-50 text-green-600 rounded hover:bg-green-100">Lihat ({{ $assignment->submissions->count() }})</a>
                            <a href="{{ route('guru.assignments.export', [$course, $assignment]) }}" class="text-xs px-2 py-1 bg-purple-50 text-purple-600 rounded hover:bg-purple-100">Export CSV</a>
                        </div>
                    </div>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $assignment->isOverdue() ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-700' }}">{{ $assignment->isOverdue() ? 'Sudah lewat' : 'Masih terbuka' }}</span>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400 bg-white rounded-lg border border-gray-100">Belum ada tugas.</div>
                @endforelse
            </div>
        </div>

        <!-- Quiz -->
        <div x-show="tab === 'quiz'" x-cloak>
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold text-gray-900">Daftar Quiz</h3>
                <a href="{{ route('guru.quizzes.create', $course) }}" class="text-xs px-3 py-1.5 bg-primary text-white rounded-lg hover:bg-primary-dark">+ Tambah Quiz</a>
            </div>
            <div class="space-y-2">
                @forelse($course->quizzes as $quiz)
                <div class="bg-white rounded-lg border border-gray-100 p-4 flex items-center justify-between">
                    <div>
                        <div class="font-medium text-sm text-gray-900">{{ $quiz->title }}</div>
                        <div class="text-xs text-gray-500">{{ $quiz->duration_minutes }} menit &bull; {{ $quiz->max_attempts }} percobaan &bull; {{ $quiz->questions->count() }} pertanyaan</div>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('guru.quizzes.show', [$course, $quiz]) }}" class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100">Kelola</a>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400 bg-white rounded-lg border border-gray-100">Belum ada quiz.</div>
                @endforelse
            </div>
        </div>

        <!-- Pengumuman -->
        <div x-show="tab === 'pengumuman'" x-cloak>
            <div class="mb-4">
                <h3 class="font-semibold text-gray-900 mb-3">Buat Pengumuman</h3>
                <form method="POST" action="{{ route('guru.announcements.store') }}" class="bg-white rounded-lg border border-gray-100 p-4 space-y-3">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <input type="text" name="title" placeholder="Judul pengumuman..." required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    <textarea name="content" placeholder="Isi pengumuman..." rows="3" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30"></textarea>
                    <button type="submit" class="px-4 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark">Kirim Pengumuman</button>
                </form>
            </div>
            <div class="space-y-2">
                @forelse($course->announcements as $ann)
                <div class="bg-white rounded-lg border border-gray-100 p-4">
                    <div class="flex justify-between">
                        <div class="font-medium text-sm text-gray-900">{{ $ann->title }}</div>
                        <form method="POST" action="{{ route('guru.announcements.destroy', $ann) }}" onsubmit="return confirm('Hapus?')">@csrf @method('DELETE')<button class="text-xs text-red-400 hover:text-red-600">Hapus</button></form>
                    </div>
                    <p class="text-xs text-gray-600 mt-1">{{ $ann->content }}</p>
                    <div class="text-xs text-gray-400 mt-1">{{ $ann->created_at->diffForHumans() }}</div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400 bg-white rounded-lg border border-gray-100">Belum ada pengumuman.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</x-app-layout>
