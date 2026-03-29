<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BTQR LMS - Platform pembelajaran bahasa Arab online untuk santri Bait Tahfiz Al-Quran Ridhallah">
    <title>BTQR LMS - Platform Pembelajaran Bahasa Arab</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet"/>
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --green: #1a6b3a;
            --green-dark: #145530;
            --green-light: #e8f5ef;
            --gold: #c9a227;
            --gold-light: #fdf6e3;
        }
        body { font-family: 'Figtree', sans-serif; color: #1f2937; background: #fff; }
        a { text-decoration: none; }

        /* ── NAVBAR ── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            background: rgba(255,255,255,0.95); backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(26,107,58,0.12);
            padding: 0 1.5rem;
            display: flex; align-items: center; justify-content: space-between; height: 64px;
        }
        .nav-logo { display: flex; align-items: center; gap: 0.65rem; }
        .nav-logo-icon { font-size: 1.6rem; }
        .nav-logo-text { font-weight: 800; font-size: 1.1rem; color: var(--green); }
        .nav-logo-sub { font-size: 0.7rem; color: #6b7280; font-weight: 400; margin-top: -3px; }
        .nav-links { display: flex; align-items: center; gap: 0.5rem; }
        .nav-btn {
            padding: 0.5rem 1.2rem; border-radius: 0.6rem; font-size: 0.875rem;
            font-weight: 600; transition: all 0.2s; cursor: pointer; border: none;
        }
        .nav-btn-outline { background: transparent; color: var(--green); border: 2px solid var(--green); }
        .nav-btn-outline:hover { background: var(--green); color: #fff; }
        .nav-btn-solid { background: var(--green); color: #fff; }
        .nav-btn-solid:hover { background: var(--green-dark); transform: translateY(-1px); box-shadow: 0 4px 15px rgba(26,107,58,0.3); }

        /* ── HERO ── */
        .hero {
            min-height: 100vh; padding-top: 64px;
            background: linear-gradient(160deg, #0d4d28 0%, #1a6b3a 45%, #1e7d44 70%, #145530 100%);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            text-align: center; padding-left: 1.5rem; padding-right: 1.5rem;
            position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .hero-arabic {
            font-size: clamp(1.5rem, 4vw, 2.5rem); color: var(--gold);
            text-shadow: 0 2px 20px rgba(201,162,39,0.4); margin-bottom: 1.5rem;
            direction: rtl;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25);
            color: rgba(255,255,255,0.9); padding: 0.35rem 0.85rem;
            border-radius: 99px; font-size: 0.8rem; font-weight: 500; margin-bottom: 1.25rem;
        }
        .hero h1 {
            font-size: clamp(2rem, 6vw, 4rem); font-weight: 800;
            color: #fff; line-height: 1.1; margin-bottom: 1rem;
            text-shadow: 0 2px 20px rgba(0,0,0,0.2);
        }
        .hero h1 span { color: var(--gold); }
        .hero-desc {
            font-size: clamp(0.95rem, 2vw, 1.15rem); color: rgba(255,255,255,0.8);
            max-width: 600px; line-height: 1.7; margin-bottom: 2.5rem;
        }
        .hero-btns { display: flex; gap: 0.75rem; flex-wrap: wrap; justify-content: center; }
        .btn-hero-primary {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.85rem 2rem; border-radius: 0.8rem; font-weight: 700;
            font-size: 1rem; background: #fff; color: var(--green);
            transition: all 0.2s; cursor: pointer;
        }
        .btn-hero-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.25); }
        .btn-hero-secondary {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.85rem 2rem; border-radius: 0.8rem; font-weight: 700;
            font-size: 1rem; background: rgba(255,255,255,0.12);
            border: 2px solid rgba(255,255,255,0.4); color: #fff;
            transition: all 0.2s; cursor: pointer;
        }
        .btn-hero-secondary:hover { background: rgba(255,255,255,0.2); transform: translateY(-2px); }
        .hero-stats {
            display: flex; gap: 2.5rem; margin-top: 3.5rem; flex-wrap: wrap; justify-content: center;
        }
        .stat { text-align: center; }
        .stat-num { font-size: 2rem; font-weight: 800; color: #fff; line-height: 1; }
        .stat-label { font-size: 0.8rem; color: rgba(255,255,255,0.65); margin-top: 0.2rem; }
        .stat-divider { width: 1px; background: rgba(255,255,255,0.2); align-self: stretch; }

        /* ── SECTION BASE ── */
        section { padding: 5rem 1.5rem; }
        .section-tag {
            display: inline-block; background: var(--green-light);
            color: var(--green); font-size: 0.8rem; font-weight: 700;
            padding: 0.3rem 0.85rem; border-radius: 99px; margin-bottom: 0.75rem;
            letter-spacing: 0.5px; text-transform: uppercase;
        }
        .section-title { font-size: clamp(1.5rem, 3vw, 2.25rem); font-weight: 800; color: #111827; margin-bottom: 0.75rem; }
        .section-sub { color: #6b7280; font-size: 1rem; line-height: 1.6; max-width: 560px; margin: 0 auto; }
        .text-center { text-align: center; }
        .container { max-width: 1100px; margin: 0 auto; }

        /* ── FITUR ── */
        .features-bg { background: #f9fafb; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); gap: 1.5rem; margin-top: 3rem; }
        .feature-card {
            background: #fff; border-radius: 1rem; padding: 1.75rem;
            border: 1px solid #f3f4f6; transition: all 0.25s;
        }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.08); border-color: var(--green-light); }
        .feature-icon { font-size: 2rem; margin-bottom: 1rem; display: block; }
        .feature-card h3 { font-size: 1.05rem; font-weight: 700; color: #111827; margin-bottom: 0.5rem; }
        .feature-card p { font-size: 0.875rem; color: #6b7280; line-height: 1.6; }

        /* ── ROLES ── */
        .roles-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 3rem; }
        .role-card { border-radius: 1.25rem; padding: 2rem; position: relative; overflow: hidden; }
        .role-card.admin { background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border: 1px solid #fca5a5; }
        .role-card.guru { background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%); border: 1px solid #c4b5fd; }
        .role-card.peserta { background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border: 1px solid #93c5fd; }
        .role-emoji { font-size: 2.5rem; margin-bottom: 1rem; display: block; }
        .role-card h3 { font-size: 1.15rem; font-weight: 800; margin-bottom: 0.5rem; color: #111827; }
        .role-desc { font-size: 0.85rem; color: #374151; margin-bottom: 1.25rem; }
        .role-features { list-style: none; space-y: 0.4rem; }
        .role-features li { display: flex; align-items: flex-start; gap: 0.5rem; font-size: 0.83rem; color: #4b5563; margin-bottom: 0.4rem; }
        .role-features li::before { content: '✓'; color: var(--green); font-weight: 700; flex-shrink: 0; margin-top: 0.05rem; }
        .role-cred { margin-top: 1.25rem; padding: 0.75rem 1rem; background: rgba(255,255,255,0.7); border-radius: 0.6rem; }
        .role-cred code { font-size: 0.78rem; color: #374151; font-family: monospace; }

        /* ── HOW IT WORKS ── */
        .steps-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 3rem; }
        .step { text-align: center; padding: 1.5rem 1rem; }
        .step-num { width: 48px; height: 48px; border-radius: 50%; background: var(--green); color: #fff; font-size: 1.25rem; font-weight: 800; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; }
        .step h4 { font-size: 0.95rem; font-weight: 700; color: #111827; margin-bottom: 0.4rem; }
        .step p { font-size: 0.83rem; color: #6b7280; line-height: 1.5; }
        .step-arrow { display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #d1d5db; padding-top: 1.5rem; }

        /* ── TECHSTACK ── */
        .tech-bg { background: var(--green); }
        .tech-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 1rem; margin-top: 3rem; }
        .tech-card {
            background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
            border-radius: 0.85rem; padding: 1.25rem 1rem; text-align: center; transition: all 0.2s;
        }
        .tech-card:hover { background: rgba(255,255,255,0.18); transform: translateY(-2px); }
        .tech-icon { font-size: 2rem; margin-bottom: 0.6rem; display: block; }
        .tech-name { font-size: 0.85rem; font-weight: 700; color: #fff; }
        .tech-sub { font-size: 0.75rem; color: rgba(255,255,255,0.65); margin-top: 0.2rem; }

        /* ── CTA ── */
        .cta-section { background: linear-gradient(135deg, #f9fafb 0%, var(--green-light) 100%); }
        .cta-card {
            background: var(--green); border-radius: 1.5rem; padding: 3.5rem 2rem;
            text-align: center; max-width: 700px; margin: 0 auto;
            box-shadow: 0 20px 60px rgba(26,107,58,0.3);
        }
        .cta-card h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: #fff; margin-bottom: 0.75rem; }
        .cta-card p { color: rgba(255,255,255,0.8); font-size: 0.95rem; margin-bottom: 2rem; }
        .cta-btns { display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; }
        .btn-cta-white {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.8rem 1.75rem; border-radius: 0.75rem; background: #fff;
            color: var(--green); font-weight: 700; font-size: 0.95rem; transition: all 0.2s;
        }
        .btn-cta-white:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0,0,0,0.2); }
        .btn-cta-outline {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.8rem 1.75rem; border-radius: 0.75rem;
            border: 2px solid rgba(255,255,255,0.5); color: #fff;
            font-weight: 700; font-size: 0.95rem; transition: all 0.2s;
        }
        .btn-cta-outline:hover { background: rgba(255,255,255,0.1); }

        /* ── FOOTER ── */
        footer { background: #0d1f14; color: rgba(255,255,255,0.7); padding: 2.5rem 1.5rem; text-align: center; }
        footer .footer-logo { font-size: 1.5rem; font-weight: 800; color: #fff; margin-bottom: 0.3rem; }
        footer .footer-sub { font-size: 0.8rem; margin-bottom: 1.25rem; }
        footer .footer-links { display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap; margin-bottom: 1.5rem; }
        footer .footer-links a { font-size: 0.83rem; color: rgba(255,255,255,0.55); transition: color 0.2s; }
        footer .footer-links a:hover { color: var(--gold); }
        footer .footer-copy { font-size: 0.78rem; color: rgba(255,255,255,0.35); }

        /* ── SCROLL ANIM ── */
        [data-aos] { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
        [data-aos].aos-visible { opacity: 1; transform: none; }
        @media (max-width: 640px) {
            .stat-divider { display: none; }
            .step-arrow { display: none; }
        }
    </style>
</head>
<body>

<!-- ══════════ NAVBAR ══════════ -->
<nav>
    <div class="nav-logo">
        <span class="nav-logo-icon">🕌</span>
        <div>
            <div class="nav-logo-text">BTQR LMS</div>
            <div class="nav-logo-sub">Bait Tahfiz Al-Quran Ridhallah</div>
        </div>
    </div>
    <div class="nav-links">
        <a href="#fitur" class="nav-btn nav-btn-outline">Fitur</a>
        <a href="{{ route('login') }}" class="nav-btn nav-btn-solid">Masuk →</a>
    </div>
</nav>

<!-- ══════════ HERO ══════════ -->
<section class="hero">
    <div class="hero-arabic" dir="rtl">بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</div>
    <span class="hero-badge">🌟 Platform LMS Resmi BTQR</span>
    <h1>Belajar Bahasa Arab<br>Lebih <span>Mudah & Menyenangkan</span></h1>
    <p class="hero-desc">Platform digital terpadu untuk santri, guru, dan administrator Bait Tahfiz Al-Quran Ridhallah. Akses materi, kerjakan tugas, dan ikuti ujian kapan saja, di mana saja.</p>

    <div class="hero-btns">
        <a href="{{ route('login') }}" class="btn-hero-primary">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
            Masuk ke Platform
        </a>
        <a href="{{ route('auth.google') }}" class="btn-hero-secondary">
            <svg width="18" height="18" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
            Masuk dengan Google
        </a>
    </div>

    <div class="hero-stats">
        <div class="stat"><div class="stat-num">3</div><div class="stat-label">Peran Pengguna</div></div>
        <div class="stat-divider"></div>
        <div class="stat"><div class="stat-num">∞</div><div class="stat-label">Materi Belajar</div></div>
        <div class="stat-divider"></div>
        <div class="stat"><div class="stat-num">100%</div><div class="stat-label">Gratis untuk Santri</div></div>
        <div class="stat-divider"></div>
        <div class="stat"><div class="stat-num">24/7</div><div class="stat-label">Akses Online</div></div>
    </div>
</section>

<!-- ══════════ FITUR ══════════ -->
<section class="features-bg" id="fitur">
    <div class="container">
        <div class="text-center">
            <span class="section-tag">✨ Fitur Unggulan</span>
            <h2 class="section-title">Semua yang Dibutuhkan dalam Satu Platform</h2>
            <p class="section-sub">Dirancang khusus untuk kebutuhan pembelajaran bahasa Arab di lingkungan BTQR.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card" data-aos>
                <span class="feature-icon">📚</span>
                <h3>Manajemen Materi</h3>
                <p>Upload dan kelola materi dalam berbagai format — PDF, video, audio, teks, hingga tautan eksternal. Santri dapat menandai materi yang sudah selesai dipelajari.</p>
            </div>
            <div class="feature-card" data-aos>
                <span class="feature-icon">📝</span>
                <h3>Sistem Tugas & Penilaian</h3>
                <p>Buat tugas dengan batas waktu, terima jawaban berupa file upload atau essay, berikan nilai dan umpan balik, dan ekspor rekap nilai ke CSV.</p>
            </div>
            <div class="feature-card" data-aos>
                <span class="feature-icon">🧠</span>
                <h3>Quiz Interaktif</h3>
                <p>Buat quiz pilihan ganda atau essay dengan timer countdown, batas percobaan, dan rekap nilai otomatis untuk setiap santri.</p>
            </div>
            <div class="feature-card" data-aos>
                <span class="feature-icon">📢</span>
                <h3>Pengumuman Kelas</h3>
                <p>Kirim pengumuman ke seluruh santri kelas atau pengumuman global untuk semua pengguna BTQR LMS.</p>
            </div>
            <div class="feature-card" data-aos>
                <span class="feature-icon">🔐</span>
                <h3>Login Ganda</h3>
                <p>Masuk dengan email dan password, atau gunakan akun Google (Gmail) untuk kemudahan akses santri yang sudah memiliki akun Google.</p>
            </div>
            <div class="feature-card" data-aos>
                <span class="feature-icon">📊</span>
                <h3>Dashboard Terintegrasi</h3>
                <p>Setiap peran mendapatkan dashboard yang relevan — statistik untuk admin, ringkasan kelas untuk guru, dan notifikasi tugas untuk santri.</p>
            </div>
            <div class="feature-card" data-aos>
                <span class="feature-icon">📱</span>
                <h3>Mobile-Ready</h3>
                <p>Antarmuka responsif yang nyaman diakses dari smartphone. Dilengkapi dukungan NativePHP untuk aplikasi mobile Android.</p>
            </div>
            <div class="feature-card" data-aos>
                <span class="feature-icon">🛡️</span>
                <h3>Kontrol Akses Peran</h3>
                <p>Sistem pembatasan akses berlapis berdasarkan peran — admin, guru, dan santri masing-masing hanya dapat mengakses fitur yang relevan.</p>
            </div>
            <div class="feature-card" data-aos>
                <span class="feature-icon">⚡</span>
                <h3>Cepat & Ringan</h3>
                <p>Dibangun dengan Laravel 12, Livewire 3, dan Alpine.js untuk pengalaman yang responsif. Database SQLite ringan dan mudah dikelola.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ ROLES ══════════ -->
<section>
    <div class="container">
        <div class="text-center">
            <span class="section-tag">👥 Tiga Peran</span>
            <h2 class="section-title">Dirancang untuk Semua Pengguna</h2>
            <p class="section-sub">Setiap pengguna mendapatkan pengalaman yang disesuaikan dengan peran dan kebutuhannya.</p>
        </div>
        <div class="roles-grid" style="margin-top:3rem">
            <div class="role-card admin" data-aos>
                <span class="role-emoji">🛠️</span>
                <h3>Administrator</h3>
                <p class="role-desc">Mengelola seluruh ekosistem LMS dari satu panel terpusat.</p>
                <ul class="role-features">
                    <li>Manajemen akun pengguna (CRUD)</li>
                    <li>Reset password & nonaktifkan akun</li>
                    <li>Buat dan kelola kelas</li>
                    <li>Assign guru ke kelas</li>
                    <li>Dashboard statistik global</li>
                    <li>Kelola pengumuman global</li>
                </ul>
                <div class="role-cred">
                    <code>admin@btqr.id &nbsp;/&nbsp; admin123</code>
                </div>
            </div>
            <div class="role-card guru" data-aos>
                <span class="role-emoji">👨‍🏫</span>
                <h3>Guru / Pengajar</h3>
                <p class="role-desc">Mengelola konten pembelajaran dan memantau perkembangan santri.</p>
                <ul class="role-features">
                    <li>Upload materi (PDF/video/audio/link)</li>
                    <li>Buat dan kelola tugas</li>
                    <li>Nilai jawaban & beri umpan balik</li>
                    <li>Export nilai ke CSV</li>
                    <li>Buat quiz interaktif</li>
                    <li>Kirim pengumuman kelas</li>
                </ul>
                <div class="role-cred">
                    <code>guru@btqr.id &nbsp;/&nbsp; guru123</code>
                </div>
            </div>
            <div class="role-card peserta" data-aos>
                <span class="role-emoji">🎓</span>
                <h3>Peserta / Santri</h3>
                <p class="role-desc">Belajar dengan interaktif dan pantau progress pembelajaran.</p>
                <ul class="role-features">
                    <li>Akses materi kelas terdaftar</li>
                    <li>Tandai materi selesai</li>
                    <li>Kumpulkan tugas (file/essay)</li>
                    <li>Ikuti quiz dengan timer</li>
                    <li>Lihat nilai & umpan balik</li>
                    <li>Terima pengumuman kelas</li>
                </ul>
                <div class="role-cred">
                    <code>santri@btqr.id &nbsp;/&nbsp; santri123</code>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ HOW IT WORKS ══════════ -->
<section class="features-bg">
    <div class="container">
        <div class="text-center">
            <span class="section-tag">🚀 Cara Kerja</span>
            <h2 class="section-title">Mulai Belajar dalam 4 Langkah</h2>
            <p class="section-sub">Proses yang mudah dari pendaftaran hingga mulai belajar.</p>
        </div>
        <div class="steps-grid" style="margin-top:3rem">
            <div class="step" data-aos>
                <div class="step-num">1</div>
                <h4>Akun Dibuat Admin</h4>
                <p>Administrator membuat akun santri dengan password awal dari tanggal lahir (format DDMMYY).</p>
            </div>
            <div class="step-arrow">→</div>
            <div class="step" data-aos>
                <div class="step-num">2</div>
                <h4>Login ke Platform</h4>
                <p>Santri masuk menggunakan email dan password, atau langsung dengan akun Google.</p>
            </div>
            <div class="step-arrow">→</div>
            <div class="step" data-aos>
                <div class="step-num">3</div>
                <h4>Akses Kelas</h4>
                <p>Santri dapat langsung mengakses kelas yang sudah didaftarkan oleh administrator.</p>
            </div>
            <div class="step-arrow">→</div>
            <div class="step" data-aos>
                <div class="step-num">4</div>
                <h4>Belajar & Berkembang</h4>
                <p>Pelajari materi, kerjakan tugas, dan ikuti quiz untuk mengukur pemahaman.</p>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ TECH STACK ══════════ -->
<section class="tech-bg">
    <div class="container">
        <div class="text-center">
            <span class="section-tag" style="background:rgba(255,255,255,0.15);color:#fff">⚙️ Teknologi</span>
            <h2 class="section-title" style="color:#fff;margin-top:0.5rem">Dibangun dengan Teknologi Modern</h2>
            <p class="section-sub" style="color:rgba(255,255,255,0.7)">Stack teknologi terkini untuk performa dan keandalan terbaik.</p>
        </div>
        <div class="tech-grid">
            <div class="tech-card"><span class="tech-icon">🐘</span><div class="tech-name">PHP 8.4</div><div class="tech-sub">Runtime</div></div>
            <div class="tech-card"><span class="tech-icon">⚡</span><div class="tech-name">Laravel 12</div><div class="tech-sub">Framework</div></div>
            <div class="tech-card"><span class="tech-icon">🔴</span><div class="tech-name">Livewire 3</div><div class="tech-sub">Reaktif</div></div>
            <div class="tech-card"><span class="tech-icon">🏔️</span><div class="tech-name">Alpine.js</div><div class="tech-sub">Interaktivitas</div></div>
            <div class="tech-card"><span class="tech-icon">💨</span><div class="tech-name">Tailwind CSS</div><div class="tech-sub">Styling</div></div>
            <div class="tech-card"><span class="tech-icon">🗃️</span><div class="tech-name">SQLite</div><div class="tech-sub">Database</div></div>
            <div class="tech-card"><span class="tech-icon">🔑</span><div class="tech-name">Google OAuth</div><div class="tech-sub">Autentikasi</div></div>
            <div class="tech-card"><span class="tech-icon">📱</span><div class="tech-name">NativePHP</div><div class="tech-sub">Mobile</div></div>
        </div>
    </div>
</section>

<!-- ══════════ CTA ══════════ -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card">
            <div style="font-size:2.5rem;margin-bottom:0.75rem">🕌</div>
            <h2>Siap Memulai Perjalanan<br>Bahasa Arab Anda?</h2>
            <p>Masuk sekarang dan akses seluruh materi pembelajaran bahasa Arab BTQR secara gratis.</p>
            <div class="cta-btns">
                <a href="{{ route('login') }}" class="btn-cta-white">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 16l-4-4m0 0l4-4m-4 4h14"/></svg>
                    Masuk Sekarang
                </a>
                <a href="{{ route('auth.google') }}" class="btn-cta-outline">
                    <svg width="18" height="18" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                    Masuk dengan Google
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════ FOOTER ══════════ -->
<footer>
    <div class="footer-logo">🕌 BTQR LMS</div>
    <div class="footer-sub">Bait Tahfiz Al-Quran Ridhallah</div>
    <div class="footer-links">
        <a href="{{ route('login') }}">Masuk</a>
        <a href="#fitur">Fitur</a>
        <a href="#" title="Tentang BTQR">Tentang Kami</a>
    </div>
    <p class="footer-copy">© 2026 Bait Tahfiz Al-Quran Ridhallah (BTQR). Dibangun dengan ❤️ menggunakan Laravel 12 &amp; NativePHP.</p>
</footer>

<script>
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const el = document.querySelector(a.getAttribute('href'));
            if (el) { e.preventDefault(); el.scrollIntoView({ behavior: 'smooth' }); }
        });
    });
    // Scroll animation
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('aos-visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('[data-aos]').forEach(el => observer.observe(el));
    // Navbar shadow on scroll
    const nav = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        nav.style.boxShadow = window.scrollY > 20 ? '0 2px 20px rgba(0,0,0,0.1)' : '';
    });
</script>
</body>
</html>
