<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user();
        $kelasList = $mahasiswa->pesertaKelas()->with(['mataKuliah', 'dosen', 'mentor', 'sesiMentoring' => function ($q) {
            $q->where('status', 'dibuka');
        }])->get();

        $totalKelas = $kelasList->count();
        $totalSesiTersedia = $kelasList->sum(fn($k) => $k->sesiMentoring->count());

        $riwayatSesi = $mahasiswa->pesertaSesi()->with(['sesi.kelas.mataKuliah'])->latest()->take(5)->get();

        return view('mahasiswa.dashboard', compact('kelasList', 'totalKelas', 'totalSesiTersedia', 'riwayatSesi'));
    }
}
