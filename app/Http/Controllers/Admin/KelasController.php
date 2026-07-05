<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    public function index()
    {
        $kelasList = Kelas::with(['mataKuliah', 'dosen', 'mentor'])->latest()->get();
        return view('admin.classes', compact('kelasList'));
    }

    public function create()
    {
        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get();
        return view('admin.classes-create', compact('mataKuliahs', 'dosens'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => [
                'required', 'string', 'max:255',
                Rule::unique('kelas')->where(fn($q) => $q->where('mata_kuliah_id', $request->mata_kuliah_id)),
            ],
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'dosen_id' => 'required|exists:users,id',
            'mentor_id' => 'nullable|exists:users,id',
        ]);

        Kelas::create($validated);

        ActivityLogger::log('Tambah Kelas', "Admin menambahkan kelas {$validated['nama_kelas']}");

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function show(Kelas $kelas)
    {
        $kelas->load(['mataKuliah', 'dosen', 'mentor', 'sesiMentoring']);
        $pesertaKelas = User::where('role', 'mahasiswa')->where('kelas_id', $kelas->id)->get();
        return view('admin.classes-show', compact('kelas', 'pesertaKelas'));
    }

    public function edit(Kelas $kelas)
    {
        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get();
        $calonMentors = User::where('role', 'mahasiswa')->where('kelas_id', $kelas->id)->get();
        if ($kelas->mentor_id) {
            $currentMentor = User::find($kelas->mentor_id);
            if ($currentMentor && !$calonMentors->contains('id', $currentMentor->id)) {
                $calonMentors->push($currentMentor);
            }
        }
        return view('admin.classes-edit', compact('kelas', 'mataKuliahs', 'dosens', 'calonMentors'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama_kelas' => [
                'required', 'string', 'max:255',
                Rule::unique('kelas')->where(fn($q) => $q->where('mata_kuliah_id', $request->mata_kuliah_id))->ignore($kelas->id),
            ],
            'mata_kuliah_id' => 'required|exists:mata_kuliahs,id',
            'dosen_id' => 'required|exists:users,id',
            'mentor_id' => 'nullable|exists:users,id',
        ]);

        $kelas->update($validated);

        ActivityLogger::log('Update Kelas', "Admin mengupdate kelas {$kelas->nama_kelas}");

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas)
    {
        ActivityLogger::log('Hapus Kelas', "Admin menghapus kelas {$kelas->nama_kelas}");
        $kelas->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
