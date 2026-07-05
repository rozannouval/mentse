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
        $totalKelas = Kelas::count();
        $sesiAktif = SesiMentoring::where('status', 'dibuka')->count();
        $kelasTanpaMentor = Kelas::whereNull('mentor_id')->count();

        $recentSesi = SesiMentoring::with(['kelas.mataKuliah', 'kelas.dosen'])->latest()->take(5)->get();

        $kelasPerBulan = SesiMentoring::selectRaw('MONTH(tanggal) as bulan, COUNT(*) as total')
            ->whereYear('tanggal', date('Y'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('total', 'bulan');

        $roleDistribusi = [
            'dosen' => User::where('role', 'dosen')->count(),
            'mentor' => User::where('role', 'mentor')->count(),
            'mahasiswa' => User::where('role', 'mahasiswa')->count(),
        ];

        return view('admin.dashboard', compact(
            'totalUser', 'totalKelas', 'sesiAktif', 'kelasTanpaMentor',
            'recentSesi', 'kelasPerBulan', 'roleDistribusi'
        ));
    }
}
