<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%")
            ->orWhere('email', 'like', "%{$request->search}%"))
            ->when($request->role, fn($q) => $q->where('role', $request->role))
            ->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role' => 'required|in:admin,guru,peserta',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $password = $validated['tanggal_lahir']
            ? \Carbon\Carbon::parse($validated['tanggal_lahir'])->format('dmy')
            : '123456';

        $user = User::create([
            ...$validated,
            'password' => Hash::make($password),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', "Pengguna {$user->name} berhasil dibuat. Password: {$password}");
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,guru,peserta',
            'tanggal_lahir' => 'nullable|date',
            'is_active' => 'boolean',
        ]);
        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function resetPassword(User $user)
    {
        $password = $user->tanggal_lahir
            ? $user->tanggal_lahir->format('dmy')
            : '123456';
        $user->update(['password' => Hash::make($password)]);
        return back()->with('success', "Password direset ke: {$password}");
    }

    public function toggleActive(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun pengguna berhasil {$status}.");
    }
}
