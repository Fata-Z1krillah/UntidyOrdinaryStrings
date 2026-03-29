<x-app-layout>
@section('title', 'Tambah Tugas')
<div class="py-4 max-w-2xl">
    <a href="{{ route('guru.courses.show', $course) }}" class="text-sm text-primary hover:underline flex items-center gap-1 mb-4">← Kembali</a>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Buat Tugas Baru - {{ $course->title }}</h2>
        <form method="POST" action="{{ route('guru.assignments.store', $course) }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Tugas *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi / Instruksi</label>
                    <textarea name="description" rows="4" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">{{ old('description') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Batas Waktu *</label>
                        <input type="datetime-local" name="deadline" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nilai Maksimum</label>
                        <input type="number" name="max_score" value="{{ old('max_score', 100) }}" min="1" max="100" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Tugas</label>
                    <select name="type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                        <option value="upload">Upload File</option>
                        <option value="essay">Essay (Teks)</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-5 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">Buat Tugas</button>
                <a href="{{ route('guru.courses.show', $course) }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
