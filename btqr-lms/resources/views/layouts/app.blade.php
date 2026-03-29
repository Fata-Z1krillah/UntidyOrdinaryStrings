<!DOCTYPE html>
<html lang="id" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'BTQR LMS') }} - @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        :root {
            --color-primary: #1a6b3a;
            --color-primary-dark: #145530;
            --color-primary-light: #e8f5ef;
            --color-gold: #c9a227;
        }
        .bg-primary { background-color: var(--color-primary); }
        .bg-primary-dark { background-color: var(--color-primary-dark); }
        .bg-primary-light { background-color: var(--color-primary-light); }
        .text-primary { color: var(--color-primary); }
        .text-gold { color: var(--color-gold); }
        .border-primary { border-color: var(--color-primary); }
        .hover\:bg-primary-dark:hover { background-color: var(--color-primary-dark); }
        .sidebar { width: 260px; min-height: 100vh; background: var(--color-primary); }
        .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 1.25rem; color: rgba(255,255,255,0.85); border-radius: 0.5rem; margin: 0.15rem 0.5rem; transition: all 0.2s; }
        .sidebar-link:hover, .sidebar-link.active { background: rgba(255,255,255,0.15); color: #fff; }
        .sidebar-link svg { width: 1.15rem; height: 1.15rem; flex-shrink: 0; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="sidebar hidden lg:flex flex-col fixed top-0 left-0 h-full z-30">
            {{-- Logo --}}
            <div class="flex items-center gap-3 px-5 py-5 border-b border-white/20">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center text-white font-bold text-lg">ب</div>
                <div>
                    <div class="text-white font-bold text-sm leading-tight">BTQR LMS</div>
                    <div class="text-white/70 text-xs">Bimbingan Bahasa Arab</div>
                </div>
            </div>

            {{-- User Info --}}
            <div class="px-5 py-4 border-b border-white/20">
                <div class="flex items-center gap-3">
                    <img src="{{ auth()->user()->avatar_url }}" class="w-9 h-9 rounded-full border-2 border-white/30" alt="">
                    <div>
                        <div class="text-white text-sm font-medium truncate max-w-[140px]">{{ auth()->user()->name }}</div>
                        <div class="text-white/60 text-xs capitalize">{{ auth()->user()->role }}</div>
                    </div>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 py-3 overflow-y-auto">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Manajemen Pengguna
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="sidebar-link {{ request()->routeIs('admin.courses*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Manajemen Kelas
                    </a>
                @elseif(auth()->user()->isGuru())
                    <a href="{{ route('guru.dashboard') }}" class="sidebar-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('guru.courses.index') }}" class="sidebar-link {{ request()->routeIs('guru.courses*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        Kelas Saya
                    </a>
                @else
                    <a href="{{ route('peserta.dashboard') }}" class="sidebar-link {{ request()->routeIs('peserta.dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                @endif
                <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile*') ? 'active' : '' }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil Saya
                </a>
            </nav>

            {{-- Logout --}}
            <div class="border-t border-white/20 p-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link w-full text-left">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 lg:ml-[260px] flex flex-col min-h-screen">
            {{-- Top Bar --}}
            <header class="bg-white shadow-sm sticky top-0 z-20 flex items-center justify-between px-4 lg:px-6 h-14">
                <div class="flex items-center gap-3">
                    {{-- Mobile menu toggle --}}
                    <button x-data @click="$dispatch('toggle-sidebar')" class="lg:hidden p-2 rounded-md text-gray-500 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-gray-800 font-semibold text-sm lg:text-base">@yield('title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-500 hidden sm:block">{{ auth()->user()->name }}</span>
                    <img src="{{ auth()->user()->avatar_url }}" class="w-8 h-8 rounded-full border border-gray-200" alt="">
                </div>
            </header>

            {{-- Flash Messages --}}
            <div class="px-4 lg:px-6 pt-4">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3 mb-4 flex items-center justify-between">
                        <span class="text-sm">{{ session('success') }}</span>
                        <button @click="show = false" class="text-green-600 hover:text-green-800 ml-3">&times;</button>
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="bg-red-50 border border-red-200 text-red-800 rounded-lg px-4 py-3 mb-4 flex items-center justify-between">
                        <span class="text-sm">{{ session('error') }}</span>
                        <button @click="show = false" class="text-red-600 hover:text-red-800 ml-3">&times;</button>
                    </div>
                @endif
            </div>

            {{-- Page Content --}}
            <main class="flex-1 px-4 lg:px-6 pb-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
