<?php

use App\Http\Controllers\Admin\AktivitasController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('mata-kuliah', MataKuliahController::class);

    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/aktivitas', [AktivitasController::class, 'index'])->name('aktivitas');

});
