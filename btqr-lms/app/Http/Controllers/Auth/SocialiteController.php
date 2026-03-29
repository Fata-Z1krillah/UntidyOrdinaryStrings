<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Login Google gagal. Silakan coba lagi.']);
        }

        $user = User::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        if (!$user) {
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Google Anda belum terdaftar. Hubungi administrator BTQR.',
            ]);
        }

        if (!$user->is_active) {
            return redirect()->route('login')->withErrors([
                'email' => 'Akun Anda tidak aktif. Hubungi administrator.',
            ]);
        }

        if (!$user->google_id) {
            $user->update(['google_id' => $googleUser->id]);
        }

        Auth::login($user, remember: true);

        return redirect()->intended($this->redirectBasedOnRole($user->role));
    }

    private function redirectBasedOnRole(string $role): string
    {
        return match($role) {
            'admin' => route('admin.dashboard'),
            'guru' => route('guru.dashboard'),
            default => route('peserta.dashboard'),
        };
    }
}
