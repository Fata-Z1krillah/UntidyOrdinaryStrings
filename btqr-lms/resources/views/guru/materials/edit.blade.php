<x-app-layout>
@section('title', 'Edit Materi')
<div class="py-4 max-w-2xl">
    <a href="{{ route('guru.courses.show', $course) }}" class="text-sm text-primary hover:underline flex items-center gap-1 mb-4">← Kembali</a>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Edit Materi: {{ $material->title }}</h2>
        <form method="POST" action="{{ route('guru.materials.update', [$course, $material]) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $material->title) }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">{{ old('description', $material->description) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                    <select name="type" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                        @foreach(['pdf', 'video', 'audio', 'text', 'link'] as $t)
                        <option value="{{ $t }}" {{ $material->type === $t ? 'selected' : '' }}>{{ strtoupper($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload File Baru (opsional)</label>
                    <input type="file" name="file" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm">
                    @if($material->file_path)<p class="text-xs text-gray-400 mt-1">File saat ini: {{ basename($material->file_path) }}</p>@endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL Eksternal</label>
                    <input type="url" name="external_url" value="{{ old('external_url', $material->external_url) }}" placeholder="https://..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-5 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">Perbarui Materi</button>
                <a href="{{ route('guru.courses.show', $course) }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
