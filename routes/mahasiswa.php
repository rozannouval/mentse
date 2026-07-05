<?php

use App\Http\Controllers\Mahasiswa\DashboardController;
use App\Http\Controllers\Mahasiswa\SesiController;
use App\Http\Controllers\Mahasiswa\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/sesi', [SesiController::class, 'index'])->name('sesi.index');
    Route::post('/sesi/{sesi}/daftar', [SesiController::class, 'daftar'])->name('sesi.daftar');

    Route::get('/riwayat', [SesiController::class, 'riwayat'])->name('riwayat');

    Route::get('/feedback/{pesertaSesi}', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback/{pesertaSesi}', [FeedbackController::class, 'store'])->name('feedback.store');

});
