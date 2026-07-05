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
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        $kelasList = Kelas::all();
        return view('admin.users-create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,dosen,mentor,mahasiswa',
            'nim' => 'nullable|string|max:20',
            'nidn' => 'nullable|string|max:20',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'nim' => $validated['nim'] ?? null,
            'nidn' => $validated['nidn'] ?? null,
            'kelas_id' => $validated['role'] === 'mahasiswa' ? ($validated['kelas_id'] ?? null) : null,
        ]);

        ActivityLogger::log('Tambah User', "Admin menambahkan user {$user->name} ({$user->email}) sebagai {$user->role}");

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $kelasList = Kelas::all();
        return view('admin.users-edit', compact('user', 'kelasList'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,dosen,mentor,mahasiswa',
            'nim' => 'nullable|string|max:20',
            'nidn' => 'nullable|string|max:20',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'nim' => $validated['nim'] ?? null,
            'nidn' => $validated['nidn'] ?? null,
            'kelas_id' => $validated['role'] === 'mahasiswa' ? ($validated['kelas_id'] ?? null) : null,
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
