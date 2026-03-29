<x-app-layout>
@section('title', 'Edit Pengguna')
<div class="py-4 max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-sm text-primary hover:underline flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>
        <h2 class="text-lg font-bold text-gray-900 mt-2">Edit Pengguna: {{ $user->name }}</h2>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PATCH')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" required class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                        <option value="peserta" {{ $user->role === 'peserta' ? 'selected' : '' }}>Peserta Didik</option>
                        <option value="guru" {{ $user->role === 'guru' ? 'selected' : '' }}>Guru/Pengajar</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir?->format('Y-m-d')) }}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary/30">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" id="is_active" {{ $user->is_active ? 'checked' : '' }} class="rounded">
                    <label for="is_active" class="text-sm text-gray-700">Akun Aktif</label>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-5 py-2 bg-primary text-white text-sm rounded-lg hover:bg-primary-dark transition-colors">Perbarui</button>
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
