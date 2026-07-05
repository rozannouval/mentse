<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\User;
use App\Models\PesertaKelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelasList = Kelas::with(['mataKuliah', 'dosen', 'mentor', 'pesertaKelas'])->latest()->get();
        return view('admin.classes', compact('kelasList'));
    }

    public function create()
    {
        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get();
        $mentors = User::where('role', 'mentor')->get();
        return view('admin.classes-create', compact('mataKuliahs', 'dosens', 'mentors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
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
        $kelas->load(['mataKuliah', 'dosen', 'mentor', 'pesertaKelas.mahasiswa', 'sesiMentoring']);
        $mahasiswas = User::where('role', 'mahasiswa')->whereDoesntHave('pesertaKelas', function ($q) use ($kelas) {
            $q->where('kelas_id', $kelas->id);
        })->get();
        return view('admin.classes-show', compact('kelas', 'mahasiswas'));
    }

    public function edit(Kelas $kelas)
    {
        $mataKuliahs = MataKuliah::all();
        $dosens = User::where('role', 'dosen')->get();
        $mentors = User::where('role', 'mentor')->get();
        return view('admin.classes-edit', compact('kelas', 'mataKuliahs', 'dosens', 'mentors'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
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

    public function addPeserta(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'mahasiswa_id' => 'required|exists:users,id',
        ]);

        $exists = PesertaKelas::where('kelas_id', $kelas->id)
            ->where('mahasiswa_id', $validated['mahasiswa_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Mahasiswa sudah terdaftar di kelas ini.');
        }

        PesertaKelas::create([
            'kelas_id' => $kelas->id,
            'mahasiswa_id' => $validated['mahasiswa_id'],
        ]);

        ActivityLogger::log('Tambah Peserta Kelas', "Admin menambah peserta ke kelas {$kelas->nama_kelas}");

        return back()->with('success', 'Mahasiswa berhasil ditambahkan ke kelas.');
    }

    public function removePeserta(Kelas $kelas, PesertaKelas $peserta)
    {
        ActivityLogger::log('Hapus Peserta Kelas', "Admin menghapus peserta dari kelas {$kelas->nama_kelas}");
        $peserta->delete();
        return back()->with('success', 'Mahasiswa berhasil dihapus dari kelas.');
    }
}
