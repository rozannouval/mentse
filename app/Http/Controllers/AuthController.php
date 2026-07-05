<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            ActivityLogger::log('Login', "User {$user->name} ({$user->email}) berhasil login sebagai {$user->role}");

            return match ($user->role) {
                'admin' => redirect()->intended('/admin/dashboard'),
                'dosen' => redirect()->intended('/dosen/dashboard'),
                'mentor' => redirect()->intended('/mentor/dashboard'),
                'mahasiswa' => redirect()->intended('/mahasiswa/dashboard'),
                default => redirect('/login'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            ActivityLogger::log('Logout', "User {$user->name} ({$user->email}) logout");
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
