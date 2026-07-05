<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\SesiMentoring;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user();

        $kelas = $mahasiswa->kelas()->with(['mataKuliah', 'dosen', 'mentor', 'sesiMentoring' => function ($q) {
            $q->where('status', 'dibuka');
        }])->first();

        $sesiTersedia = SesiMentoring::where('kelas_id', $mahasiswa->kelas_id)
            ->where('status', 'dibuka')
            ->with(['kelas.mataKuliah', 'kelas.mentor', 'pesertaSesi'])
            ->orderBy('tanggal')
            ->get();

        $riwayatSesi = $mahasiswa->pesertaSesi()->with(['sesi.kelas.mataKuliah', 'feedback'])->latest()->take(5)->get();

        $totalHadir = $riwayatSesi->where('status', 'hadir')->count();
        $totalSesiDiikuti = $riwayatSesi->count();

        return view('mahasiswa.dashboard', compact(
            'kelas', 'sesiTersedia', 'riwayatSesi',
            'totalHadir', 'totalSesiDiikuti'
        ));
    }
}
