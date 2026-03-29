<x-app-layout>
@section('title', 'Dashboard Guru')
<div class="py-4">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900">Assalamu'alaikum, {{ auth()->user()->name }}! 👋</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola materi dan pantau perkembangan santri Anda.</p>
    </div>

    @if($pending_submissions > 0)
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6 flex items-center gap-3">
        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM9 7H4l5-5v5zM12 3v6m0 6v6"/></svg>
        </div>
        <div>
            <div class="font-medium text-amber-900">{{ $pending_submissions }} tugas menunggu penilaian</div>
            <div class="text-xs text-amber-700">Santri sudah mengumpulkan tugas, segera berikan nilai.</div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($courses as $course)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="p-5">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-10 h-10 bg-primary-light rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
                    </div>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $course->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $course->status === 'active' ? 'Aktif' : 'Nonaktif' }}</span>
                </div>
                <h3 class="font-semibold text-gray-900 mb-1">{{ $course->title }}</h3>
                <p class="text-xs text-gray-500 mb-3 line-clamp-2">{{ $course->description ?? 'Tidak ada deskripsi' }}</p>
                <div class="flex gap-4 text-xs text-gray-500 mb-4">
                    <span>👥 {{ $course->students_count }} santri</span>
                    <span>📚 {{ $course->materials_count }} materi</span>
                    <span>📝 {{ $course->assignments_count }} tugas</span>
                </div>
                <a href="{{ route('guru.courses.show', $course) }}" class="w-full text-center block py-2 px-4 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">Kelola Kelas</a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-gray-400">
            <div class="text-4xl mb-3">📚</div>
            <p>Anda belum memiliki kelas. Hubungi administrator untuk membuat kelas baru.</p>
        </div>
        @endforelse
    </div>
</div>
</x-app-layout>
