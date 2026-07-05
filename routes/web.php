<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        return redirect()->match([
            'admin' => 'admin.dashboard',
            'dosen' => 'dosen.dashboard',
            'mentor' => 'mentor.dashboard',
            'mahasiswa' => 'mahasiswa.dashboard',
        ][$role] ?? 'login');
    }
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/dosen.php';
require __DIR__ . '/mentor.php';
require __DIR__ . '/mahasiswa.php';
