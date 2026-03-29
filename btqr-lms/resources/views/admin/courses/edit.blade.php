<x-app-layout>
@section('title', 'Edit Kelas')
<div class="py-4 max-w-2xl">
    <a href="{{ route('admin.courses.index') }}" class="text-sm text-primary hover:underline flex items-center gap-1 mb-4">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Kembali
    </a>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Edit Kelas</h2>
        <form method="POST" action="{{ route('admin.courses.update', $course) }}">
            @csrf @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kelas</label>
                    <input type="text" name="title" value="{{ old('title', $course->title) }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">{{ old('description', $course->description) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pengajar</label>
                    <select name="teacher_id" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                        @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                        <option value="active" {{ $course->status === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ $course->status === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-5 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">Perbarui</button>
                <a href="{{ route('admin.courses.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
