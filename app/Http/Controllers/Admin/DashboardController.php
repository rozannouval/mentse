<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\SesiMentoring;
use App\Models\PesertaSesi;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalDosen = User::where('role', 'dosen')->count();
        $totalMentor = User::where('role', 'mentor')->count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalMataKuliah = MataKuliah::count();
        $totalKelas = Kelas::count();
        $totalSesi = SesiMentoring::count();
        $totalFeedback = Feedback::count();

        $kelasTanpaMentor = Kelas::whereNull('mentor_id')->count();
        $sesiAktif = SesiMentoring::where('status', 'dibuka')->count();
        $totalPesertaSesi = PesertaSesi::count();

        $recentUsers = User::latest()->take(5)->get();
        $recentSesi = SesiMentoring::with(['kelas.mataKuliah', 'kelas.dosen'])->latest()->take(5)->get();

        $kelasPerBulan = SesiMentoring::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total')
            ->whereYear('tanggal', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        return view('admin.dashboard', compact(
            'totalUser', 'totalDosen', 'totalMentor', 'totalMahasiswa',
            'totalMataKuliah', 'totalKelas', 'totalSesi', 'totalFeedback',
            'kelasTanpaMentor', 'sesiAktif', 'totalPesertaSesi',
            'recentUsers', 'recentSesi', 'kelasPerBulan'
        ));
    }
}
