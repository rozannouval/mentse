<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\KelasController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('mata-kuliah', MataKuliahController::class);

    Route::resource('kelas', KelasController::class);
    Route::post('/kelas/{kelas}/peserta', [KelasController::class, 'addPeserta'])->name('kelas.peserta.store');
    Route::delete('/kelas/{kelas}/peserta/{peserta}', [KelasController::class, 'removePeserta'])->name('kelas.peserta.destroy');

});
