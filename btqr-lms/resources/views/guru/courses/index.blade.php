<x-app-layout>
@section('title', 'Kelas Saya')
<div class="py-4">
    <h2 class="text-lg font-bold text-gray-900 mb-4">Kelas Yang Saya Ampu</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($courses as $course)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition-shadow">
            <h3 class="font-semibold text-gray-900 mb-2">{{ $course->title }}</h3>
            <p class="text-xs text-gray-500 mb-3 line-clamp-2">{{ $course->description ?? '-' }}</p>
            <div class="flex gap-3 text-xs text-gray-400 mb-4">
                <span>👥 {{ $course->students_count }}</span>
                <span>📚 {{ $course->materials_count }}</span>
                <span>📝 {{ $course->assignments_count }}</span>
            </div>
            <a href="{{ route('guru.courses.show', $course) }}" class="block text-center py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark">Kelola</a>
        </div>
        @empty
        <div class="col-span-3 text-center py-10 text-gray-400">Belum ada kelas yang diampu.</div>
        @endforelse
    </div>
</div>
</x-app-layout>
