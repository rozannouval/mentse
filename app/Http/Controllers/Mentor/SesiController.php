<?php

namespace App\Http\Controllers\Mentor;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\SesiMentoring;
use App\Models\PesertaSesi;
use App\Models\Feedback;
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
        $kelas = Auth::user()->kelasMentor()->with('mataKuliah')->first();

        if (!$kelas) {
            return redirect()->route('mentor.dashboard')->with('error', 'Anda belum ditugaskan ke kelas mana pun.');
        }

        return view('mentor.sesi-create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $kelas = Auth::user()->kelasMentor()->first();

        if (!$kelas) {
            return back()->with('error', 'Anda tidak memiliki akses ke kelas ini.');
        }

        $validated = $request->validate([
            'topik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        $validated['kelas_id'] = $kelas->id;
        $validated['status'] = 'dibuka';

        $sesi = SesiMentoring::create($validated);

        ActivityLogger::log('Buat Sesi', "Mentor membuat sesi {$sesi->topik}");

        return redirect()->route('mentor.sesi.index')->with('success', 'Sesi mentoring berhasil dibuat.');
    }

    public function edit(SesiMentoring $sesi)
    {
        if ($sesi->kelas->mentor_id !== Auth::id()) {
            abort(403);
        }

        return view('mentor.sesi-edit', compact('sesi'));
    }

    public function update(Request $request, SesiMentoring $sesi)
    {
        if ($sesi->kelas->mentor_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'topik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'kuota' => 'required|integer|min:1',
        ]);

        $sesi->update($validated);

        ActivityLogger::log('Update Sesi', "Mentor mengupdate sesi {$sesi->topik}");

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

    public function selesai(SesiMentoring $sesi)
    {
        if ($sesi->kelas->mentor_id !== Auth::id()) {
            abort(403);
        }

        $sesi->update(['status' => 'selesai']);

        ActivityLogger::log('Selesaikan Sesi', "Mentor menyelesaikan sesi {$sesi->topik}");

        return back()->with('success', 'Sesi mentoring diselesaikan.');
    }

    public function peserta()
    {
        $mentor = Auth::user();

        $pesertaList = PesertaSesi::whereHas('sesi.kelas', function ($q) use ($mentor) {
            $q->where('mentor_id', $mentor->id);
        })->with(['mahasiswa', 'sesi.kelas.mataKuliah'])->latest()->get();

        $mkGroups = $pesertaList->groupBy(function ($p) {
            return $p->sesi->kelas->mataKuliah->id . '|' . $p->sesi->kelas->mataKuliah->nama_mata_kuliah;
        })->map(function ($items, $key) {
            [$id, $nama] = explode('|', $key, 2);
            return (object) [
                'mata_kuliah_id' => $id,
                'nama_mata_kuliah' => $nama,
                'peserta' => $items,
            ];
        })->values();

        return view('mentor.peserta', compact('mkGroups'));
    }

    public function feedback()
    {
        $mentor = Auth::user();

        $feedbackList = Feedback::whereHas('pesertaSesi.sesi.kelas', function ($q) use ($mentor) {
            $q->where('mentor_id', $mentor->id);
        })->with(['pesertaSesi.mahasiswa', 'pesertaSesi.sesi'])->latest()->get();

        $avgRating = Feedback::whereHas('pesertaSesi.sesi.kelas', function ($q) use ($mentor) {
            $q->where('mentor_id', $mentor->id);
        })->selectRaw('AVG(komunikasi) as avg_kom, AVG(penguasaan_materi) as avg_mat, AVG(kejelasan_penyampaian) as avg_peny')
            ->first();

        return view('mentor.feedback', compact('feedbackList', 'avgRating'));
    }
}
