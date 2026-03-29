<x-guest-layout>
    <div class="text-center mb-5">
        <h2 class="text-xl font-bold text-gray-800">Masuk ke BTQR LMS</h2>
        <p class="text-gray-500 text-sm mt-1">Silakan masuk dengan akun Anda</p>
    </div>

    <!-- Google Login -->
    <a href="{{ route('auth.google') }}" class="flex items-center justify-center gap-3 w-full py-2.5 px-4 border-2 border-gray-200 rounded-xl text-gray-700 font-medium text-sm hover:border-green-600 hover:bg-green-50 transition-all mb-4">
        <svg width="20" height="20" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
        Masuk dengan Google
    </a>

    <div class="flex items-center gap-3 mb-4">
        <div class="flex-1 h-px bg-gray-200"></div>
        <span class="text-gray-400 text-xs">atau dengan email</span>
        <div class="flex-1 h-px bg-gray-200"></div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-3" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-3">
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-gray-700" />
                <x-text-input id="email" class="block mt-1 w-full rounded-xl border-gray-200 focus:ring-green-600 focus:border-green-600 text-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-700" />
                <x-text-input id="password" class="block mt-1 w-full rounded-xl border-gray-200 focus:ring-green-600 focus:border-green-600 text-sm" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>
        </div>

        <div class="flex items-center justify-between mt-3">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-700 focus:ring-green-500" name="remember">
                <span class="ms-2 text-xs text-gray-500">Ingat saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-xs text-green-700 hover:text-green-900" href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="mt-4 w-full py-2.5 bg-green-700 hover:bg-green-800 text-white font-semibold rounded-xl text-sm transition-colors">
            Masuk
        </button>
    </form>

    <div class="mt-4 text-center text-xs text-gray-400">
        <p>Demo: <code>admin@btqr.id</code> / <code>admin123</code></p>
        <p>Guru: <code>guru@btqr.id</code> / <code>guru123</code></p>
        <p>Santri: <code>santri@btqr.id</code> / <code>santri123</code></p>
    </div>
</x-guest-layout>
