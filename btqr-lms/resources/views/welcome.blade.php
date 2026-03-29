<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BTQR LMS - Bimbingan Bahasa Arab</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet"/>
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body { font-family: 'Figtree', sans-serif; margin: 0; background: linear-gradient(135deg, #0d4d28 0%, #1a6b3a 50%, #145530 100%); min-height: 100vh; }
        .hero { min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; text-align: center; }
        .card { background: rgba(255,255,255,0.97); border-radius: 1.5rem; padding: 3rem 2.5rem; max-width: 480px; width: 100%; box-shadow: 0 25px 50px rgba(0,0,0,0.25); }
        .logo { font-size: 3rem; margin-bottom: 0.5rem; }
        h1 { color: #1a6b3a; font-size: 1.75rem; font-weight: 700; margin: 0 0 0.25rem; }
        .subtitle { color: #555; font-size: 0.95rem; margin-bottom: 0.5rem; }
        .org { color: #1a6b3a; font-weight: 600; font-size: 0.9rem; margin-bottom: 2rem; }
        .arabic { font-size: 1.5rem; color: #c9a227; margin: 1rem 0; }
        .btn { display: block; width: 100%; padding: 0.85rem 1.5rem; border-radius: 0.75rem; font-weight: 600; font-size: 1rem; text-decoration: none; text-align: center; transition: all 0.2s; cursor: pointer; border: none; }
        .btn-primary { background: #1a6b3a; color: #fff; margin-bottom: 0.75rem; }
        .btn-primary:hover { background: #145530; transform: translateY(-1px); box-shadow: 0 8px 20px rgba(26,107,58,0.35); }
        .btn-google { background: #fff; color: #333; border: 2px solid #e5e7eb; display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
        .btn-google:hover { border-color: #1a6b3a; background: #f9fafb; }
        .divider { display: flex; align-items: center; gap: 1rem; margin: 1rem 0; color: #9ca3af; font-size: 0.85rem; }
        .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: #e5e7eb; }
        .footer { margin-top: 2rem; color: rgba(255,255,255,0.7); font-size: 0.8rem; }
    </style>
</head>
<body>
    <div class="hero">
        <div class="card">
            <div class="logo">🕌</div>
            <h1>BTQR LMS</h1>
            <p class="subtitle">Learning Management System</p>
            <p class="org">Bait Tahfiz Al-Quran Ridhallah</p>
            <div class="arabic" dir="rtl">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</div>
            <p style="color:#666;font-size:0.85rem;margin-bottom:1.5rem;">Platform pembelajaran bahasa Arab online untuk santri BTQR di seluruh Indonesia</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Masuk ke Platform</a>
            <div class="divider">atau</div>
            <a href="{{ route('auth.google') }}" class="btn btn-google">
                <svg width="20" height="20" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                Masuk dengan Google
            </a>
        </div>
        <div class="footer">
            <p>© 2026 Bait Tahfiz Al-Quran Ridhallah (BTQR) &bull; Powered by Laravel 12 &amp; NativePHP</p>
        </div>
    </div>
</body>
</html>
