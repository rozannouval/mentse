<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roleRoute = $user->role;
        return view('profile.index', compact('user', 'roleRoute'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        if ($user->role === 'mahasiswa') {
            $rules['nim'] = 'nullable|string|max:20';
        }
        if ($user->role === 'dosen') {
            $rules['nidn'] = 'nullable|string|max:20';
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->role === 'mahasiswa' && $request->has('nim')) {
            $user->nim = $request->nim;
        }
        if ($user->role === 'dosen' && $request->has('nidn')) {
            $user->nidn = $request->nidn;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        $user->save();

        ActivityLogger::log('Update Profil', "User {$user->name} mengupdate profil");

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
