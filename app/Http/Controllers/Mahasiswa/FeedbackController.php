<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PesertaSesi;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbackList = Feedback::whereHas('pesertaSesi', function ($q) {
            $q->where('mahasiswa_id', Auth::id());
        })->with(['pesertaSesi.sesi.kelas.mataKuliah'])->latest()->get();

        return view('mahasiswa.feedback-index', compact('feedbackList'));
    }

    public function create(PesertaSesi $pesertaSesi)
    {
        if ($pesertaSesi->mahasiswa_id !== Auth::id()) {
            abort(403);
        }

        if ($pesertaSesi->status !== 'hadir') {
            return redirect()->route('mahasiswa.riwayat')->with('error', 'Feedback hanya dapat diisi jika Anda hadir.');
        }

        if ($pesertaSesi->feedback()->exists()) {
            return redirect()->route('mahasiswa.riwayat')->with('error', 'Anda sudah mengisi feedback untuk sesi ini.');
        }

        $pesertaSesi->load(['sesi.kelas.mataKuliah']);

        return view('mahasiswa.feedback', compact('pesertaSesi'));
    }

    public function store(Request $request, PesertaSesi $pesertaSesi)
    {
        if ($pesertaSesi->mahasiswa_id !== Auth::id()) {
            abort(403);
        }

        if ($pesertaSesi->status !== 'hadir') {
            return redirect()->route('mahasiswa.riwayat')->with('error', 'Feedback hanya dapat diisi jika Anda hadir.');
        }

        $validated = $request->validate([
            'komunikasi' => 'required|integer|min:1|max:5',
            'penguasaan_materi' => 'required|integer|min:1|max:5',
            'kejelasan_penyampaian' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        Feedback::create([
            'peserta_sesi_id' => $pesertaSesi->id,
            'komunikasi' => $validated['komunikasi'],
            'penguasaan_materi' => $validated['penguasaan_materi'],
            'kejelasan_penyampaian' => $validated['kejelasan_penyampaian'],
            'komentar' => $validated['komentar'],
        ]);

        return redirect()->route('mahasiswa.riwayat')->with('success', 'Feedback berhasil dikirim.');
    }
}
