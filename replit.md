# BTQR LMS - Learning Management System

Platform LMS berbasis web untuk Bait Tahfiz Al-Quran Ridhallah (BTQR).

## Teknologi
- **Framework**: Laravel 12 (PHP 8.4)
- **Frontend**: Blade + Livewire 3 + Alpine.js + Tailwind CSS
- **Database**: SQLite
- **Auth**: Laravel Breeze (Email/Password) + Google OAuth (Socialite)
- **Mobile**: NativePHP Mobile (Android)
- **Build**: Vite

## Struktur Proyek
Proyek berada di direktori `btqr-lms/` (subdirektori dari root Replit).

## Cara Menjalankan
Workflow: `cd btqr-lms && npm run build && php artisan serve --host=0.0.0.0 --port=5000`

## Akun Demo
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@btqr.id | admin123 |
| Guru | guru@btqr.id | guru123 |
| Santri | santri@btqr.id | santri123 |

## Fitur Utama
### Admin
- Dashboard statistik (total pengguna, kelas, pengumpulan tugas)
- Manajemen pengguna (CRUD, reset password, nonaktifkan akun)
- Manajemen kelas (CRUD, assign guru)

### Guru
- Dashboard kelas yang diampu
- Manajemen materi (upload PDF/video/audio/link)
- Manajemen tugas (buat soal, nilai jawaban, export CSV)
- Manajemen quiz (buat quiz pilihan ganda/essay)
- Pengumuman kelas

### Peserta
- Dashboard kelas terdaftar
- Belajar materi (tandai selesai)
- Mengumpulkan tugas (upload/essay)
- Mengikuti quiz dengan timer

## Desain
- Warna tema: Hijau Islami #1a6b3a + Emas #c9a227
- Layout: Sidebar + header responsive

## Database
- SQLite di `btqr-lms/database/database.sqlite`
- 13 tabel migrasi: users, courses, materials, assignments, submissions, quizzes, quiz_questions, quiz_answers, quiz_attempts, announcements, enrollments, progress, certificates

## Google OAuth
Konfigurasi di `.env`:
```
GOOGLE_CLIENT_ID=...
GOOGLE_CLIENT_SECRET=...
GOOGLE_REDIRECT_URI=https://your-domain/auth/google/callback
```

## Password Default
Password dibuat otomatis dari tanggal lahir format DDMMYY (contoh: 070705 untuk 7 Juli 2005).
