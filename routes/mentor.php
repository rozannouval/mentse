<?php

use App\Http\Controllers\Mentor\DashboardController;
use App\Http\Controllers\Mentor\SesiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:mentor'])->prefix('mentor')->name('mentor.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('sesi', SesiController::class);
    Route::get('/sesi/{sesi}/presensi', [SesiController::class, 'presensi'])->name('sesi.presensi');
    Route::put('/sesi/{sesi}/presensi/{peserta}', [SesiController::class, 'updatePresensi'])->name('sesi.presensi.update');
    Route::put('/sesi/{sesi}/tutup', [SesiController::class, 'tutup'])->name('sesi.tutup');
    Route::put('/sesi/{sesi}/selesai', [SesiController::class, 'selesai'])->name('sesi.selesai');
    Route::get('/peserta', [SesiController::class, 'peserta'])->name('peserta');
    Route::get('/feedback', [SesiController::class, 'feedback'])->name('feedback');

});
