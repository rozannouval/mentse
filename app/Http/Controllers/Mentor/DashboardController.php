<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\SesiMentoring;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mentor = Auth::user();
        $kelasList = $mentor->kelasMentor()->with(['mataKuliah', 'dosen', 'sesiMentoring.pesertaSesi'])->get();

        $totalSesi = $kelasList->sum(fn($k) => $k->sesiMentoring->count());
        $totalPeserta = $kelasList->sum(fn($k) => $k->sesiMentoring->sum(fn($s) => $s->pesertaSesi->count()));
        $sesiAktif = $kelasList->sum(fn($k) => $k->sesiMentoring->where('status', 'dibuka')->count());

        $sesiMendatang = SesiMentoring::whereHas('kelas', function ($q) use ($mentor) {
            $q->where('mentor_id', $mentor->id);
        })->whereIn('status', ['dibuka'])->whereDate('tanggal', '>=', now()->subDay())->orderBy('tanggal')->get();

        $recentFeedback = Feedback::whereHas('pesertaSesi.sesi.kelas', function ($q) use ($mentor) {
            $q->where('mentor_id', $mentor->id);
        })->with(['pesertaSesi.mahasiswa', 'pesertaSesi.sesi'])->latest()->take(5)->get();

        $avgRating = Feedback::whereHas('pesertaSesi.sesi.kelas', function ($q) use ($mentor) {
            $q->where('mentor_id', $mentor->id);
        })->selectRaw('AVG(komunikasi) as avg_kom, AVG(penguasaan_materi) as avg_mat, AVG(kejelasan_penyampaian) as avg_peny')
            ->first();

        return view('mentor.dashboard', compact(
            'kelasList', 'totalSesi', 'totalPeserta', 'sesiAktif',
            'sesiMendatang', 'recentFeedback', 'avgRating'
        ));
    }
}
