<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\CourseController as AdminCourse;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\CourseController as GuruCourse;
use App\Http\Controllers\Guru\MaterialController as GuruMaterial;
use App\Http\Controllers\Guru\AssignmentController as GuruAssignment;
use App\Http\Controllers\Guru\QuizController as GuruQuiz;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboard;
use App\Http\Controllers\Peserta\CourseController as PesertaCourse;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route(auth()->user()->role . '.dashboard');
    }
    return view('welcome');
})->name('home');

// Google OAuth
Route::get('/auth/google', [SocialiteController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback'])->name('auth.google.callback');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('/users', AdminUser::class);
    Route::post('/users/{user}/reset-password', [AdminUser::class, 'resetPassword'])->name('users.reset-password');
    Route::post('/users/{user}/toggle-active', [AdminUser::class, 'toggleActive'])->name('users.toggle-active');
    Route::resource('/courses', AdminCourse::class);
    Route::post('/courses/{course}/enroll', [AdminCourse::class, 'enrollStudents'])->name('courses.enroll');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});

// Guru Routes
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');
    Route::get('/courses', [GuruCourse::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [GuruCourse::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/materials/create', [GuruMaterial::class, 'create'])->name('materials.create');
    Route::post('/courses/{course}/materials', [GuruMaterial::class, 'store'])->name('materials.store');
    Route::get('/courses/{course}/materials/{material}/edit', [GuruMaterial::class, 'edit'])->name('materials.edit');
    Route::put('/courses/{course}/materials/{material}', [GuruMaterial::class, 'update'])->name('materials.update');
    Route::delete('/courses/{course}/materials/{material}', [GuruMaterial::class, 'destroy'])->name('materials.destroy');
    Route::get('/courses/{course}/assignments/create', [GuruAssignment::class, 'create'])->name('assignments.create');
    Route::post('/courses/{course}/assignments', [GuruAssignment::class, 'store'])->name('assignments.store');
    Route::get('/courses/{course}/assignments/{assignment}', [GuruAssignment::class, 'show'])->name('assignments.show');
    Route::post('/courses/{course}/assignments/{assignment}/grade/{submission}', [GuruAssignment::class, 'grade'])->name('assignments.grade');
    Route::delete('/courses/{course}/assignments/{assignment}', [GuruAssignment::class, 'destroy'])->name('assignments.destroy');
    Route::get('/courses/{course}/assignments/{assignment}/export', [GuruAssignment::class, 'exportNilai'])->name('assignments.export');
    Route::get('/courses/{course}/quizzes/create', [GuruQuiz::class, 'create'])->name('quizzes.create');
    Route::post('/courses/{course}/quizzes', [GuruQuiz::class, 'store'])->name('quizzes.store');
    Route::get('/courses/{course}/quizzes/{quiz}', [GuruQuiz::class, 'show'])->name('quizzes.show');
    Route::post('/courses/{course}/quizzes/{quiz}/questions', [GuruQuiz::class, 'addQuestion'])->name('quizzes.questions.store');
    Route::delete('/courses/{course}/quizzes/{quiz}', [GuruQuiz::class, 'destroy'])->name('quizzes.destroy');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
});

// Peserta Routes
Route::middleware(['auth', 'role:peserta'])->prefix('peserta')->name('peserta.')->group(function () {
    Route::get('/dashboard', [PesertaDashboard::class, 'index'])->name('dashboard');
    Route::get('/courses/{course}', [PesertaCourse::class, 'show'])->name('courses.show');
    Route::post('/courses/{course}/assignments/{assignment}/submit', [PesertaCourse::class, 'submitAssignment'])->name('assignments.submit');
    Route::post('/courses/{course}/materials/{material}/done', [PesertaCourse::class, 'markMaterialDone'])->name('materials.done');
    Route::get('/courses/{course}/quizzes/{quiz}/start', [PesertaCourse::class, 'startQuiz'])->name('quizzes.start');
    Route::post('/courses/{course}/quizzes/{quiz}/attempts/{attempt}/submit', [PesertaCourse::class, 'submitQuiz'])->name('quizzes.submit');
});

// Profile (shared)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Dashboard redirect based on role
Route::get('/dashboard', function () {
    return redirect()->route(auth()->user()->role . '.dashboard');
})->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';
