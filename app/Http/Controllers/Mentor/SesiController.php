<?php

namespace App\Http\Controllers\Mentor;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\SesiMentoring;
use App\Models\PesertaSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index()
    {
        $sesiList = SesiMentoring::whereHas('kelas', function ($q) {
            $q->where('mentor_id', Auth::id());
        })->with(['kelas.mataKuliah', 'pesertaSesi'])->latest()->get();

        return view('mentor.sesi', compact('sesiList'));
    }

    public function create()
    {
        $kelasList = Auth::user()->kelasMentor()->with('mataKuliah')->get();

        if ($kelasList->isEmpty()) {
            return redirect()->route('mentor.dashboard')->with('error', 'Anda belum ditugaskan ke kelas mana pun.');
        }

        return view('mentor.sesi-create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'topik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        $kelas = Auth::user()->kelasMentor()->find($validated['kelas_id']);

        if (!$kelas) {
            return back()->with('error', 'Anda tidak memiliki akses ke kelas ini.');
        }

        $validated['status'] = 'dibuka';

        $sesi = SesiMentoring::create($validated);

        ActivityLogger::log('Buat Sesi', "Mentor {$sesi->kelas->mentor->name} membuat sesi {$sesi->topik}");

        return redirect()->route('mentor.sesi.index')->with('success', 'Sesi mentoring berhasil dibuat.');
    }

    public function edit(SesiMentoring $sesi)
    {
        if ($sesi->kelas->mentor_id !== Auth::id()) {
            abort(403);
        }

        $kelasList = Auth::user()->kelasMentor()->with('mataKuliah')->get();

        return view('mentor.sesi-edit', compact('sesi', 'kelasList'));
    }

    public function update(Request $request, SesiMentoring $sesi)
    {
        if ($sesi->kelas->mentor_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'topik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        $sesi->update($validated);

        ActivityLogger::log('Update Sesi', "Mentor {$sesi->kelas->mentor->name} mengupdate sesi {$sesi->topik}");

        return redirect()->route('mentor.sesi.index')->with('success', 'Sesi mentoring berhasil diperbarui.');
    }

    public function destroy(SesiMentoring $sesi)
    {
        if ($sesi->kelas->mentor_id !== Auth::id()) {
            abort(403);
        }

        ActivityLogger::log('Hapus Sesi', "Mentor menghapus sesi {$sesi->topik}");
        $sesi->delete();
        return redirect()->route('mentor.sesi.index')->with('success', 'Sesi mentoring berhasil dihapus.');
    }

    public function presensi(SesiMentoring $sesi)
    {
        if ($sesi->kelas->mentor_id !== Auth::id()) {
            abort(403);
        }

        $sesi->load(['pesertaSesi.mahasiswa']);
        return view('mentor.sesi-presensi', compact('sesi'));
    }

    public function updatePresensi(Request $request, SesiMentoring $sesi, PesertaSesi $peserta)
    {
        if ($sesi->kelas->mentor_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:hadir,tidak_hadir',
        ]);

        $peserta->update(['status' => $validated['status']]);

        return back()->with('success', 'Presensi berhasil diperbarui.');
    }

    public function tutup(SesiMentoring $sesi)
    {
        if ($sesi->kelas->mentor_id !== Auth::id()) {
            abort(403);
        }

        $sesi->update(['status' => 'ditutup']);

        ActivityLogger::log('Tutup Sesi', "Mentor menutup sesi {$sesi->topik}");

        return back()->with('success', 'Sesi mentoring ditutup.');
    }
}
