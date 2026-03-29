<div align="center">

# 🕌 BTQR LMS

**Platform Learning Management System Bait Tahfiz Al-Quran Ridhallah**

*بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ*

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![Livewire](https://img.shields.io/badge/Livewire-3.x-FB70A9?style=flat)](https://livewire.laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind-4.x-38BDF8?style=flat&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![SQLite](https://img.shields.io/badge/SQLite-3.x-003B57?style=flat&logo=sqlite&logoColor=white)](https://sqlite.org)

</div>

---

## 📋 1. Deskripsi Proyek

**BTQR LMS** adalah platform pembelajaran online (*Learning Management System*) yang dirancang khusus untuk **Bait Tahfiz Al-Quran Ridhallah (BTQR)**. Platform ini memfasilitasi kegiatan belajar-mengajar bahasa Arab secara digital — dari distribusi materi, penugasan, kuis interaktif, hingga pemantauan perkembangan santri.

### Tujuan
- Digitalisasi proses belajar-mengajar di lingkungan BTQR
- Memberikan akses materi bahasa Arab kapan saja dan di mana saja
- Memudahkan guru dalam mengelola tugas dan menilai santri
- Memberikan administrator kendali penuh atas ekosistem pembelajaran

### Fitur Utama

| Fitur | Admin | Guru | Santri |
|-------|:-----:|:----:|:------:|
| Dashboard Statistik | ✅ | ✅ | ✅ |
| Manajemen Pengguna (CRUD) | ✅ | ❌ | ❌ |
| Manajemen Kelas | ✅ | 👁️ | 👁️ |
| Upload Materi (PDF/Video/Audio) | ❌ | ✅ | ❌ |
| Buat Tugas & Penilaian | ❌ | ✅ | ❌ |
| Kumpulkan Tugas | ❌ | ❌ | ✅ |
| Buat Quiz Interaktif | ❌ | ✅ | ❌ |
| Ikuti Quiz (dengan Timer) | ❌ | ❌ | ✅ |
| Pengumuman Kelas/Global | ✅ | ✅ | 👁️ |
| Login Google OAuth | ✅ | ✅ | ✅ |
| Export Nilai ke CSV | ❌ | ✅ | ❌ |
| Reset Password Pengguna | ✅ | ❌ | ❌ |

> ✅ = Dapat dilakukan &nbsp;·&nbsp; 👁️ = Hanya lihat &nbsp;·&nbsp; ❌ = Tidak dapat akses

---

## 🚀 2. Panduan Instalasi Cepat

### Prasyarat

```bash
php --version     # PHP >= 8.4
composer --version
node --version    # Node.js >= 20.x
npm --version
```

### Langkah Instalasi

```bash
# 1. Clone repositori
git clone <repository-url>
cd btqr-lms

# 2. Install dependensi PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Buat file database SQLite
touch database/database.sqlite

# 6. Jalankan migrasi database (13 tabel)
php artisan migrate

# 7. Isi data awal (akun demo)
php artisan db:seed --class=AdminSeeder

# 8. Buat symlink storage untuk file upload
php artisan storage:link

# 9. Install dependensi frontend
npm install

# 10. Build aset untuk production
npm run build

# 11. Jalankan server
php artisan serve --host=0.0.0.0 --port=8000
```

Buka browser: **http://localhost:8000**

### Mode Development (Hot Reload)

```bash
# Terminal 1 — Backend server
php artisan serve

# Terminal 2 — Frontend Vite (HMR)
npm run dev
```

### Jalankan di Replit

```bash
# Satu perintah untuk Replit (port 5000)
npm run build && php artisan serve --host=0.0.0.0 --port=5000
```

---

## 💻 3. Tech Stack Utama

### Backend

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **PHP** | 8.4 | Runtime server-side |
| **Laravel** | 12.x | MVC framework utama |
| **Laravel Breeze** | 2.x | Auth scaffolding (login/register/reset) |
| **Laravel Socialite** | 5.x | Google OAuth 2.0 integration |
| **SQLite** | 3.x | Database embedded ringan |
| **NativePHP Mobile** | 3.x | Android app packaging |

### Frontend

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Blade** | built-in | Server-side templating engine |
| **Livewire** | 3.x | Reactive server-driven UI components |
| **Alpine.js** | 3.x | Lightweight JavaScript interactivity |
| **Tailwind CSS** | 4.x | Utility-first CSS framework |
| **Vite** | 7.x | Asset bundler dan dev server |

### Desain & UI

- 🟢 **Warna Primer**: `#1a6b3a` — Hijau Islami
- 🟡 **Aksen Emas**: `#c9a227` — Gold
- 📐 **Layout**: Sidebar vertikal + Header sticky
- 🖋️ **Typography**: Figtree (via Bunny Fonts CDN)
- 📱 **Responsif**: Mobile-first dengan breakpoint Tailwind

### Layanan Eksternal

| Layanan | Fungsi |
|---------|--------|
| Google OAuth API | Login dengan akun Google |
| UI Avatars API | Foto profil default santri |
| Bunny CDN Fonts | Font Figtree |

---

## 👥 4. User Roles & Kredensial Default

### Tiga Peran Pengguna

#### 🛠️ Administrator
Mengelola seluruh ekosistem LMS dari satu panel terpusat.
- Manajemen akun pengguna (buat, edit, hapus, nonaktifkan)
- Reset password pengguna (otomatis dari tanggal lahir)
- Buat dan kelola kelas, assign guru ke kelas
- Pantau statistik global platform
- Kirim pengumuman ke semua pengguna

#### 👨‍🏫 Guru / Pengajar
Mengelola konten pembelajaran dan memantau perkembangan santri.
- Upload materi: PDF, video, audio, teks, atau tautan eksternal
- Buat tugas dengan deadline, terima file upload atau essay
- Nilai jawaban santri, beri umpan balik, ekspor nilai ke CSV
- Buat quiz pilihan ganda/essay dengan timer countdown
- Kirim pengumuman untuk santri di kelas yang diampu

#### 🎓 Peserta / Santri
Mengakses konten pembelajaran secara interaktif.
- Akses materi di kelas yang sudah didaftarkan admin
- Tandai materi yang sudah selesai dipelajari
- Kumpulkan tugas (upload file atau essay)
- Ikuti quiz dengan timer otomatis
- Lihat nilai dan umpan balik dari guru
- Terima pengumuman kelas dan global

### Akun Demo Siap Pakai

| Peran | Email | Password |
|-------|-------|----------|
| 🛠️ Administrator | `admin@btqr.id` | `admin123` |
| 👨‍🏫 Guru | `guru@btqr.id` | `guru123` |
| 🎓 Santri | `santri@btqr.id` | `santri123` |

### Sistem Password Default

Saat admin membuat akun baru, password awal dibuat otomatis dari tanggal lahir:

```
Format  : DDMMYY (6 digit)
Contoh  : Lahir 7 Juli 2005   → password: 070705
          Lahir 15 Maret 2003 → password: 150303

Admin dapat mereset password kapan saja via panel admin.
Santri disarankan mengganti password setelah login pertama.
```

---

## 🗂️ 5. Struktur Direktori

```
btqr-lms/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                ← Panel administrator
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── UserController.php
│   │   │   │   └── CourseController.php
│   │   │   ├── Guru/                 ← Panel guru
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── CourseController.php
│   │   │   │   ├── MaterialController.php
│   │   │   │   ├── AssignmentController.php
│   │   │   │   └── QuizController.php
│   │   │   ├── Peserta/              ← Panel santri
│   │   │   │   ├── DashboardController.php
│   │   │   │   └── CourseController.php
│   │   │   ├── Auth/
│   │   │   │   └── SocialiteController.php   ← Google OAuth
│   │   │   └── AnnouncementController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php    ← Pembatasan akses per peran
│   └── Models/                       ← 13 Eloquent models
│       ├── User.php
│       ├── Course.php
│       ├── Material.php
│       ├── Assignment.php
│       ├── Submission.php
│       ├── Quiz.php
│       ├── QuizQuestion.php
│       ├── QuizAnswer.php
│       ├── QuizAttempt.php
│       ├── Enrollment.php
│       ├── Announcement.php
│       ├── Progress.php
│       └── Certificate.php
│
├── database/
│   ├── migrations/                   ← 13 file migrasi
│   ├── seeders/
│   │   └── AdminSeeder.php           ← Data demo
│   └── database.sqlite               ← File database SQLite
│
├── resources/
│   ├── css/app.css                   ← Entry point Tailwind CSS
│   ├── js/app.js                     ← Entry point Alpine.js + Livewire
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php         ← Layout utama (sidebar + nav)
│       │   └── guest.blade.php       ← Layout halaman auth
│       ├── welcome.blade.php         ← Landing page
│       ├── auth/                     ← Login, register, dll.
│       ├── admin/                    ← Views panel admin
│       ├── guru/                     ← Views panel guru
│       └── peserta/                  ← Views panel santri
│
├── routes/
│   └── web.php                       ← Semua route (admin/guru/peserta)
│
├── config/
│   └── services.php                  ← Konfigurasi Google OAuth
│
├── .env                              ← Environment variables
├── Architecture-Diagram.md           ← Dokumentasi arsitektur sistem
└── README.md                         ← Dokumentasi proyek (file ini)
```

---

## ⚙️ 6. Konfigurasi

### Environment Variables Penting (`.env`)

```env
# Identitas Aplikasi
APP_NAME="BTQR LMS"
APP_ENV=local
APP_DEBUG=true           # Ubah ke false di production!
APP_URL=http://localhost
APP_LOCALE=id

# Database SQLite
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database/database.sqlite

# Google OAuth 2.0
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# Mail (untuk fitur lupa password)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@btqr.id
MAIL_FROM_NAME="BTQR LMS"
```

### Konfigurasi Google OAuth

1. Buka [Google Cloud Console](https://console.cloud.google.com)
2. **APIs & Services** → **Credentials** → **Create Credentials** → **OAuth 2.0 Client ID**
3. Application type: **Web application**
4. Authorized redirect URIs: `https://your-domain.com/auth/google/callback`
5. Salin **Client ID** dan **Client Secret** ke `.env`

> **Penting**: Pengguna login via Google harus sudah terdaftar oleh admin terlebih dahulu. BTQR LMS tidak mengizinkan registrasi mandiri via Google.

---

## 🗃️ 7. Skema Database (13 Tabel)

```
users             → Akun pengguna (admin, guru, santri)
courses           → Kelas/mata pelajaran
materials         → Materi (PDF, video, audio, teks, link)
assignments       → Tugas dengan deadline
submissions       → Pengumpulan tugas santri
quizzes           → Quiz/ujian
quiz_questions    → Pertanyaan quiz
quiz_answers      → Pilihan jawaban (multiple choice)
quiz_attempts     → Riwayat percobaan quiz + skor
enrollments       → Daftar santri di tiap kelas (pivot)
announcements     → Pengumuman kelas atau global
progress          → Progress belajar materi (polymorphic)
certificates      → Sertifikat penyelesaian (future feature)
```

### Perintah Database

```bash
# Jalankan migrasi baru
php artisan migrate

# Reset semua tabel
php artisan migrate:fresh

# Reset + isi data awal
php artisan migrate:fresh --seed

# Hanya isi ulang data demo
php artisan db:seed --class=AdminSeeder
```

---

## 📱 8. NativePHP (Mobile Android)

```bash
# Publikasi konfigurasi NativePHP
php artisan native:install

# Build APK untuk Android
php artisan native:build android

# Jalankan di emulator
php artisan native:run android
```

**Prasyarat Android:**
- Android Studio dengan SDK API level 30+
- JDK 17 atau lebih baru
- USB Debugging aktif (untuk perangkat fisik)

---

## 🔒 9. Keamanan

| Lapisan | Implementasi |
|---------|-------------|
| CSRF Protection | `@csrf` token di semua form POST |
| SQL Injection | Eloquent ORM dengan prepared statements |
| XSS Prevention | Blade `{{ }}` auto-escape semua output |
| Role Authorization | `RoleMiddleware` di setiap grup route |
| File Upload | Validasi MIME type dan ukuran maksimum |
| Password Hashing | Bcrypt (12 rounds) via `Hash::make()` |
| Session Security | `Session::regenerate()` setiap login |
| Google OAuth | Hanya email terdaftar admin yang bisa masuk |
| Account Status | Cek `is_active` setiap kali login |
| Ownership Check | Guru hanya bisa akses kelas miliknya sendiri |

---

## 🤝 10. Kontribusi

1. Fork repositori ini
2. Buat branch fitur baru:
   ```bash
   git checkout -b feature/nama-fitur
   ```
3. Commit perubahan:
   ```bash
   git commit -m "feat: deskripsi fitur baru"
   ```
4. Push ke branch:
   ```bash
   git push origin feature/nama-fitur
   ```
5. Buat Pull Request ke branch `main`

### Konvensi Commit Message

```
feat:     Penambahan fitur baru
fix:      Perbaikan bug
docs:     Perubahan dokumentasi
style:    Perubahan styling (tidak mengubah logika)
refactor: Refactoring kode
perf:     Peningkatan performa
```

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah **MIT License** — lihat file [LICENSE](LICENSE) untuk detail.

---

<div align="center">

**Dibangun dengan ❤️ untuk kemajuan pendidikan Islam di Indonesia**

*© 2026 Bait Tahfiz Al-Quran Ridhallah (BTQR)*

*Laravel 12 · PHP 8.4 · Livewire 3 · Alpine.js · Tailwind CSS · NativePHP*

</div>
