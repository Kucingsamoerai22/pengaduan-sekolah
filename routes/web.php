<?php

use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', [AspirasiController::class, 'index'])->name('dashboard');

    // ================= RUTE KHUSUS SISWA (STUDENT) =================
    Route::middleware('role:student')->group(function () {
        Route::post('/aspirasi/store', [AspirasiController::class, 'store'])->name('aspirasi.store');
        // PASTIKAN BARIS INI ADA:
        Route::delete('/aspirasi/destroy/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
    });

    // ================= RUTE KHUSUS ADMIN =================
    Route::middleware('role:admin')->group(function () {
        Route::post('/aspirasi/update/{id}', [AspirasiController::class, 'update'])->name('aspirasi.update');
        
        // Fitur Arsip Admin
        Route::get('/aspirasi/archived', [AspirasiController::class, 'archivedPage'])->name('aspirasi.archived');
        Route::post('/aspirasi/archive/{id}', [AspirasiController::class, 'archive'])->name('aspirasi.archive');
        Route::post('/aspirasi/restore/{id}', [AspirasiController::class, 'restore'])->name('aspirasi.restore');
    });
});

// Rute Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';