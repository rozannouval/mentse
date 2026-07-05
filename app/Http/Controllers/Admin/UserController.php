<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('kelas')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        $kelasList = Kelas::with('mataKuliah')->get();
        return view('admin.users-create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:dosen,mentor,mahasiswa',
        ];

        $role = $request->role;

        if (in_array($role, ['mahasiswa', 'mentor'])) {
            $rules['nim'] = 'required|string|max:20|unique:users,nim';
        }
        if ($role === 'dosen') {
            $rules['nidn'] = 'required|string|max:20|unique:users,nidn';
        }
        if ($role === 'mahasiswa') {
            $rules['kelas_id'] = 'required|exists:kelas,id';
        }

        $validated = $request->validate($rules);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nim' => in_array($role, ['mahasiswa', 'mentor']) ? ($validated['nim'] ?? null) : null,
            'nidn' => $role === 'dosen' ? ($validated['nidn'] ?? null) : null,
            'kelas_id' => $role === 'mahasiswa' ? ($validated['kelas_id'] ?? null) : null,
        ]);

        ActivityLogger::log('Tambah User', "Admin menambahkan user {$user->name} ({$user->email}) sebagai {$user->role}");

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $kelasList = Kelas::with('mataKuliah')->get();
        return view('admin.users-edit', compact('user', 'kelasList'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,dosen,mentor,mahasiswa',
        ];

        $role = $user->role === 'admin' ? 'admin' : $request->role;

        if (in_array($role, ['mahasiswa', 'mentor'])) {
            $rules['nim'] = 'required|string|max:20|unique:users,nim,' . $user->id;
        }
        if ($role === 'dosen') {
            $rules['nidn'] = 'required|string|max:20|unique:users,nidn,' . $user->id;
        }
        if ($role === 'mahasiswa') {
            $rules['kelas_id'] = 'required|exists:kelas,id';
        }

        $validated = $request->validate($rules);

        $role = $user->role === 'admin' ? 'admin' : $validated['role'];

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $role,
            'nim' => in_array($role, ['mahasiswa', 'mentor']) ? ($validated['nim'] ?? null) : null,
            'nidn' => $role === 'dosen' ? ($validated['nidn'] ?? null) : null,
            'kelas_id' => $role === 'mahasiswa' ? ($validated['kelas_id'] ?? null) : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($validated['password']);
        }

        $oldRole = $user->role;
        $user->update($data);

        ActivityLogger::log('Update User', "Admin mengupdate user {$user->name} role: {$oldRole} -> {$validated['role']}");

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat menghapus admin.');
        }
        ActivityLogger::log('Hapus User', "Admin menghapus user {$user->name} ({$user->email})");
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
