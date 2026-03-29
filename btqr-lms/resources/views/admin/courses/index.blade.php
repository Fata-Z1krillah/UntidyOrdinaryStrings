<x-app-layout>
@section('title', 'Manajemen Kelas')
<div class="py-4">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-gray-900">Manajemen Kelas</h2>
        <a href="{{ route('admin.courses.create') }}" class="px-4 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Kelas
        </a>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Kelas</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Pengajar</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Santri</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                    <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($courses as $course)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3">
                        <div class="font-medium text-gray-900">{{ $course->title }}</div>
                        <div class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $course->description }}</div>
                    </td>
                    <td class="px-5 py-3 text-gray-600">{{ $course->teacher->name ?? '-' }}</td>
                    <td class="px-5 py-3 text-gray-600">{{ $course->students_count }} santri</td>
                    <td class="px-5 py-3">
                        <span class="px-2 py-0.5 rounded-full text-xs {{ $course->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $course->status === 'active' ? 'Aktif' : 'Nonaktif' }}</span>
                    </td>
                    <td class="px-5 py-3">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.courses.edit', $course) }}" class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100">Edit</a>
                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" onsubmit="return confirm('Hapus kelas ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-xs px-2 py-1 bg-red-50 text-red-600 rounded hover:bg-red-100">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-10 text-gray-400">Belum ada kelas.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($courses->hasPages())
        <div class="px-5 py-3 border-t border-gray-100">{{ $courses->links() }}</div>
        @endif
    </div>
</div>
</x-app-layout>
