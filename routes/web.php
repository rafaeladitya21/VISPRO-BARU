<?php

use Illuminate\Support\Facades\Route;

// ========== HALAMAN UTAMA (PUBLIK) ==========
Route::get('/', function () {
    return view('dashboard');
})->name('home');
