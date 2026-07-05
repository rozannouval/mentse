<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dosen = Auth::user();
        $kelasList = $dosen->kelasDosen()->with(['mataKuliah', 'mentor', 'sesiMentoring.pesertaSesi'])->get();

        $totalKelas = $kelasList->count();
        $totalSesi = $kelasList->sum(fn($k) => $k->sesiMentoring->count());
        $kelasTanpaMentor = $kelasList->filter(fn($k) => !$k->mentor_id)->count();
        $totalPeserta = $kelasList->sum(fn($k) => $k->sesiMentoring->sum(fn($s) => $s->pesertaSesi->count()));
        $sesiAktif = $kelasList->sum(fn($k) => $k->sesiMentoring->where('status', 'dibuka')->count());
        $totalFeedback = Feedback::whereHas('pesertaSesi.sesi.kelas', function ($q) use ($dosen) {
            $q->where('dosen_id', $dosen->id);
        })->count();

        $kelasIds = $kelasList->pluck('id');
        $recentFeedback = Feedback::whereHas('pesertaSesi.sesi.kelas', function ($q) use ($kelasIds) {
            $q->whereIn('id', $kelasIds);
        })->with(['pesertaSesi.mahasiswa', 'pesertaSesi.sesi.kelas'])->latest()->take(5)->get();

        return view('dosen.dashboard', compact(
            'kelasList', 'totalKelas', 'totalSesi', 'kelasTanpaMentor',
            'totalPeserta', 'sesiAktif', 'totalFeedback', 'recentFeedback'
        ));
    }
}
