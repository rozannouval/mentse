<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use App\Models\SesiMentoring;
use App\Models\PesertaSesi;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalDosen = User::where('role', 'dosen')->count();
        $totalMentor = User::where('role', 'mentor')->count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalKelas = Kelas::count();
        $totalSesi = SesiMentoring::count();
        $totalFeedback = Feedback::count();
        $totalHadir = PesertaSesi::where('status', 'hadir')->count();
        $totalTidakHadir = PesertaSesi::where('status', 'tidak_hadir')->count();
        $rateKehadiran = $totalHadir + $totalTidakHadir > 0
            ? round(($totalHadir / ($totalHadir + $totalTidakHadir)) * 100, 1)
            : 0;

        $kelasList = Kelas::with(['mataKuliah', 'dosen', 'mentor', 'sesiMentoring'])
            ->withCount(['sesiMentoring as sesi_selesai' => function ($q) {
                $q->where('status', 'selesai');
            }])
            ->get()
            ->map(function ($k) {
                $totalPeserta = $k->sesiMentoring->sum(fn($s) => $s->pesertaSesi->count());
                $totalHadirKelas = $k->sesiMentoring->sum(fn($s) => $s->pesertaSesi->where('status', 'hadir')->count());
                $k->total_peserta_sesi = $totalPeserta;
                $k->total_hadir = $totalHadirKelas;
                return $k;
            });

        return view('admin.laporan', compact(
            'totalUser', 'totalDosen', 'totalMentor', 'totalMahasiswa',
            'totalKelas', 'totalSesi', 'totalFeedback',
            'totalHadir', 'totalTidakHadir', 'rateKehadiran',
            'kelasList'
        ));
    }
}
