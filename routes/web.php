<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PesertaSesiController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/dosen/dashboard', function () { return "Dashboard Dosen"; });
    Route::get('/mentor/dashboard', function () { return "Dashboard Mentor"; });
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () { 
        return "Dashboard Admin"; 
    })->name('dashboard');

    Route::get('/classes', [KelasController::class, 'index'])->name('classes.index');
    
    Route::get('/courses', [MataKuliahController::class, 'index'])->name('courses.index');
    
    Route::get('/reports', function () { 
        return view('admin.reports'); 
    })->name('reports.index');
    
    Route::get('/users', function () { 
        return view('admin.users'); 
    })->name('users.index');
});

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('student.')->group(function () {

    Route::get('/dashboard', function () {
        return "Dashboard Mahasiswa"; 
    })->name('dashboard');

    Route::get('/sessions', [PesertaSesiController::class, 'index'])->name('sessions');
    Route::post('/sessions', [PesertaSesiController::class, 'store'])->name('sessions.store');

    Route::get('/history', [PesertaSesiController::class, 'history'])->name('history');

    Route::get('/feedback', [FeedbackController::class, 'create'])->name('feedback');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

});
