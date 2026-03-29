<x-app-layout>
@section('title', 'Buat Quiz')
<div class="py-4 max-w-2xl">
    <a href="{{ route('guru.courses.show', $course) }}" class="text-sm text-primary hover:underline flex items-center gap-1 mb-4">← Kembali</a>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Buat Quiz - {{ $course->title }}</h2>
        <form method="POST" action="{{ route('guru.quizzes.store', $course) }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Quiz *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="2" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">{{ old('description') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Durasi (menit) *</label>
                        <input type="number" name="duration_minutes" value="{{ old('duration_minutes', 60) }}" required min="1" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Maks. Percobaan</label>
                        <input type="number" name="max_attempts" value="{{ old('max_attempts', 1) }}" min="1" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tersedia Dari</label>
                        <input type="datetime-local" name="available_from" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tersedia Sampai</label>
                        <input type="datetime-local" name="available_until" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-5 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">Buat Quiz</button>
                <a href="{{ route('guru.courses.show', $course) }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
