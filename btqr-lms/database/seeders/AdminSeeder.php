<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(['email' => 'admin@btqr.id'], [
            'name' => 'Administrator BTQR',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Guru demo
        $guru = User::firstOrCreate(['email' => 'guru@btqr.id'], [
            'name' => 'Ustadz Ahmad Fauzi',
            'role' => 'guru',
            'password' => Hash::make('guru123'),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Peserta demo
        $peserta = User::firstOrCreate(['email' => 'santri@btqr.id'], [
            'name' => 'Muhammad Ali Hasan',
            'role' => 'peserta',
            'password' => Hash::make('santri123'),
            'tanggal_lahir' => '2005-07-07',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Demo Course
        $course = Course::firstOrCreate(['title' => 'Bahasa Arab Dasar'], [
            'description' => 'Kelas bahasa Arab dasar untuk pemula, mencakup kosakata, tata bahasa, dan percakapan sehari-hari.',
            'teacher_id' => $guru->id,
            'status' => 'active',
        ]);

        // Enroll peserta
        $course->students()->syncWithoutDetaching([$peserta->id => ['enrolled_at' => now()]]);
    }
}
