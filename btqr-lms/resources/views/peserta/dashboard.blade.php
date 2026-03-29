<x-app-layout>
@section('title', 'Dashboard Peserta')
<div class="py-4">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900">Assalamu'alaikum, {{ auth()->user()->name }}! 🌟</h2>
        <p class="text-gray-500 text-sm mt-1">Semangat belajar bahasa Arab hari ini!</p>
    </div>

    @if($pending_assignments > 0)
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6 flex items-center gap-3">
        <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        <div>
            <div class="font-medium text-amber-900">{{ $pending_assignments }} tugas belum dikumpulkan</div>
            <div class="text-xs text-amber-700">Segera kumpulkan sebelum batas waktu!</div>
        </div>
    </div>
    @endif

    <!-- Announcements -->
    @if($announcements->count() > 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="px-5 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-900">📢 Pengumuman Terbaru</h3>
        </div>
        <div class="divide-y divide-gray-50">
            @foreach($announcements as $ann)
            <div class="px-5 py-3">
                <div class="flex items-start justify-between gap-2">
                    <div>
                        <div class="font-medium text-sm text-gray-900">{{ $ann->title }}</div>
                        <p class="text-xs text-gray-600 mt-0.5 line-clamp-2">{{ $ann->content }}</p>
                        <div class="text-xs text-gray-400 mt-1">{{ $ann->created_at->diffForHumans() }} &bull; {{ $ann->author->name }}</div>
                    </div>
                    @if($ann->is_global)
                    <span class="text-xs px-2 py-0.5 bg-green-100 text-green-700 rounded-full flex-shrink-0">Global</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Courses -->
    <h3 class="font-semibold text-gray-900 mb-3">Kelas Saya</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($courses as $course)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="p-5">
                <div class="w-10 h-10 bg-primary-light rounded-lg flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg>
                </div>
                <h4 class="font-semibold text-gray-900 mb-1">{{ $course->title }}</h4>
                <p class="text-xs text-gray-500 mb-1">👨‍🏫 {{ $course->teacher->name }}</p>
                <div class="flex gap-3 text-xs text-gray-400 mb-4">
                    <span>📚 {{ $course->materials_count }} materi</span>
                    <span>📝 {{ $course->assignments_count }} tugas</span>
                </div>
                <a href="{{ route('peserta.courses.show', $course) }}" class="block w-full text-center py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">Buka Kelas</a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-gray-400">
            <div class="text-4xl mb-3">📚</div>
            <p>Anda belum terdaftar di kelas manapun. Hubungi admin BTQR.</p>
        </div>
        @endforelse
    </div>
</div>
</x-app-layout>
