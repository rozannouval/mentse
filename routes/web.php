<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        $targetRoute = match ($user->role) {
            'admin'     => 'admin.dashboard',
            'dosen'     => 'dosen.dashboard',
            'mentor'    => 'mentor.dashboard',
            'mahasiswa' => 'mahasiswa.dashboard',
            default     => 'login',
        };

        return redirect()->route($targetRoute);
    }
    return view('auth.login');
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
