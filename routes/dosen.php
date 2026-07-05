<?php

use App\Http\Controllers\Dosen\DashboardController;
use App\Http\Controllers\Dosen\KelasController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/kelas/{kelas}', [KelasController::class, 'show'])->name('kelas.show');
    Route::put('/kelas/{kelas}/pilih-mentor', [KelasController::class, 'pilihMentor'])->name('kelas.pilih-mentor');

});
