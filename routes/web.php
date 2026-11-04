<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AiAssistantController;
use Illuminate\Support\Facades\Auth;

// ========== HALAMAN UTAMA (PUBLIK) ==========
// "/" sekarang menampilkan halaman dashboard (landing publik)
// Konten otomatis menyesuaikan via @auth/@guest pada view.
Route::get('/', function () {
    return view('dashboard');
})->name('home');

// ========== GRUP ROUTE TERPROTEKSI (HARUS LOGIN) ==========
// /dashboard khusus admin yang sudah login.
// /karyawan & /ai butuh login agar tidak bisa diakses publik.
Route::middleware(['auth'])->group(function () {

    // Rute Dashboard admin (setelah login)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute AI Assistant
    Route::get('/ai', [AiAssistantController::class, 'index'])->name('ai.index');
    Route::post('/ai/ask', [AiAssistantController::class, 'ask'])->name('ai.ask');

    // Rute Karyawan (CRUD)
    Route::resource('karyawan', EmployeeController::class);
});

// Rute Logout (di luar auth group supaya form logout selalu bisa kirim)
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');