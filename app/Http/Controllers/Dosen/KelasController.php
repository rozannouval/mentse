<?php

namespace App\Http\Controllers\Dosen;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $kelasList = Auth::user()->kelasDosen()->with(['mataKuliah', 'mentor'])->get();
        return view('dosen.kelas', compact('kelasList'));
    }

    public function show(Kelas $kelas)
    {
        if ($kelas->dosen_id !== Auth::id()) {
            abort(403);
        }

        $kelas->load(['mataKuliah', 'mentor', 'pesertaKelas.mahasiswa', 'sesiMentoring']);

        $mahasiswas = User::where('role', 'mahasiswa')
            ->whereHas('pesertaKelas', function ($q) use ($kelas) {
                $q->where('kelas_id', $kelas->id);
            })->get();

        return view('dosen.kelas-show', compact('kelas', 'mahasiswas'));
    }

    public function pilihMentor(Request $request, Kelas $kelas)
    {
        if ($kelas->dosen_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'mentor_id' => 'required|exists:users,id',
        ]);

        $calonMentor = User::findOrFail($validated['mentor_id']);

        if ($calonMentor->role !== 'mahasiswa' && $calonMentor->role !== 'mentor') {
            return back()->with('error', 'Hanya mahasiswa yang dapat ditunjuk menjadi mentor.');
        }

        $terdaftar = $calonMentor->pesertaKelas()->where('kelas_id', $kelas->id)->exists();
        if (!$terdaftar && $calonMentor->role === 'mahasiswa') {
            return back()->with('error', 'Mahasiswa tersebut tidak terdaftar di kelas ini.');
        }

        $kelas->update(['mentor_id' => $calonMentor->id]);

        if ($calonMentor->role === 'mahasiswa') {
            $calonMentor->update(['role' => 'mentor']);
        }

        ActivityLogger::log('Pilih Mentor', "Dosen {$kelas->dosen->name} menunjuk mentor {$calonMentor->name} untuk kelas {$kelas->nama_kelas}");

        return back()->with('success', 'Mentor berhasil ditunjuk.');
    }
}
