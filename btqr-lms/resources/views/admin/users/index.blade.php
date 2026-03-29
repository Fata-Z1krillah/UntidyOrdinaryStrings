<x-app-layout>
@section('title', 'Manajemen Pengguna')
<div class="py-4">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Manajemen Pengguna</h2>
            <p class="text-gray-500 text-sm">Kelola semua akun pengguna LMS BTQR</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Pengguna
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4">
        <form method="GET" class="flex gap-3 p-4">
            <input type="text" name="search" placeholder="Cari nama atau email..." value="{{ request('search') }}" class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
            <select name="role" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="guru" {{ request('role') === 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="peserta" {{ request('role') === 'peserta' ? 'selected' : '' }}>Peserta</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white text-sm rounded-lg hover:bg-gray-700">Filter</button>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Pengguna</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Role</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Tgl. Lahir</th>
                        <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $user->avatar_url }}" class="w-8 h-8 rounded-full" alt="">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'guru' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700') }}">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ $user->tanggal_lahir ? $user->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100">Edit</a>
                                <form method="POST" action="{{ route('admin.users.reset-password', $user) }}" class="inline" onsubmit="return confirm('Reset password pengguna ini?')">
                                    @csrf
                                    <button type="submit" class="text-xs px-2 py-1 bg-yellow-50 text-yellow-600 rounded hover:bg-yellow-100">Reset PW</button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.toggle-active', $user) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs px-2 py-1 {{ $user->is_active ? 'bg-red-50 text-red-600 hover:bg-red-100' : 'bg-green-50 text-green-600 hover:bg-green-100' }} rounded">{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-10 text-gray-400">Tidak ada pengguna ditemukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
        <div class="px-5 py-3 border-t border-gray-100">{{ $users->appends(request()->query())->links() }}</div>
        @endif
    </div>
</div>
</x-app-layout>
