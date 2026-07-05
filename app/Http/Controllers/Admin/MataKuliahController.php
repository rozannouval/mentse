<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliahs = MataKuliah::query()->latest()->get();
        return view('admin.courses', compact('mataKuliahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_mata_kuliah' => 'required|string|max:255',
        ]);

        MataKuliah::create($validated);

        ActivityLogger::log('Tambah Mata Kuliah', "Admin menambahkan mata kuliah {$validated['nama_mata_kuliah']}");

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $validated = $request->validate([
            'nama_mata_kuliah' => 'required|string|max:255',
        ]);

        $mataKuliah->update($validated);

        ActivityLogger::log('Update Mata Kuliah', "Admin mengupdate mata kuliah {$mataKuliah->nama_mata_kuliah}");

        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        ActivityLogger::log('Hapus Mata Kuliah', "Admin menghapus mata kuliah {$mataKuliah->nama_mata_kuliah}");
        $mataKuliah->delete();
        return redirect()->route('admin.mata-kuliah.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
