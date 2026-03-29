<x-app-layout>
@section('title', 'Tambah Materi')
<div class="py-4 max-w-2xl">
    <a href="{{ route('guru.courses.show', $course) }}" class="text-sm text-primary hover:underline flex items-center gap-1 mb-4">← Kembali ke {{ $course->title }}</a>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Tambah Materi Baru</h2>
        <form method="POST" action="{{ route('guru.materials.store', $course) }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Materi *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Materi *</label>
                    <select name="type" id="type" x-data x-model="type" @change="type = $event.target.value" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                        <option value="pdf">PDF</option>
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                        <option value="text">Teks</option>
                        <option value="link">Tautan Eksternal</option>
                    </select>
                </div>
                <div x-data="{ type: 'pdf' }" x-init="document.getElementById('type').addEventListener('change', e => type = e.target.value)">
                    <div x-show="type !== 'link'">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload File</label>
                        <input type="file" name="file" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm">
                        <p class="text-xs text-gray-400 mt-1">Maks. 50MB</p>
                    </div>
                    <div x-show="type === 'link'">
                        <label class="block text-sm font-medium text-gray-700 mb-1">URL Tautan</label>
                        <input type="url" name="external_url" placeholder="https://..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" min="0" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-5 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">Tambah Materi</button>
                <a href="{{ route('guru.courses.show', $course) }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
