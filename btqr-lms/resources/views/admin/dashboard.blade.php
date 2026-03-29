<x-app-layout>
@section('title', 'Dashboard Admin')
<div class="py-4">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola seluruh sistem LMS BTQR dari sini.</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
            <div class="text-2xl font-bold text-primary">{{ $stats['total_users'] }}</div>
            <div class="text-xs text-gray-500 mt-1">Total Pengguna</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
            <div class="text-2xl font-bold text-blue-600">{{ $stats['total_peserta'] }}</div>
            <div class="text-xs text-gray-500 mt-1">Peserta Didik</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
            <div class="text-2xl font-bold text-purple-600">{{ $stats['total_guru'] }}</div>
            <div class="text-xs text-gray-500 mt-1">Pengajar</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
            <div class="text-2xl font-bold text-green-600">{{ $stats['total_courses'] }}</div>
            <div class="text-xs text-gray-500 mt-1">Total Kelas</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
            <div class="text-2xl font-bold text-orange-600">{{ $stats['total_submissions'] }}</div>
            <div class="text-xs text-gray-500 mt-1">Pengumpulan</div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100">
            <div class="text-2xl font-bold text-red-600">{{ $stats['pending_grading'] }}</div>
            <div class="text-xs text-gray-500 mt-1">Belum Dinilai</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Pengguna Terbaru</h3>
                <a href="{{ route('admin.users.index') }}" class="text-xs text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($recent_users as $user)
                <div class="flex items-center gap-3 px-5 py-3">
                    <img src="{{ $user->avatar_url }}" class="w-8 h-8 rounded-full" alt="">
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $user->email }}</div>
                    </div>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'guru' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700') }}">{{ ucfirst($user->role) }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Courses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-900">Kelas Terbaru</h3>
                <a href="{{ route('admin.courses.index') }}" class="text-xs text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recent_courses as $course)
                <div class="flex items-center gap-3 px-5 py-3">
                    <div class="w-8 h-8 bg-primary-light rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-gray-900 truncate">{{ $course->title }}</div>
                        <div class="text-xs text-gray-500">{{ $course->teacher->name ?? 'N/A' }}</div>
                    </div>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $course->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">{{ $course->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}</span>
                </div>
                @empty
                <div class="px-5 py-4 text-sm text-gray-400 text-center">Belum ada kelas</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</x-app-layout>
