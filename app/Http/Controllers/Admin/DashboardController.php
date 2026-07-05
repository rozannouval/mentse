<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\SesiMentoring;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalUser' => User::count(),
            'totalAdmin' => User::where('role', 'admin')->count(),
            'totalDosen' => User::where('role', 'dosen')->count(),
            'totalMentor' => User::where('role', 'mentor')->count(),
            'totalMahasiswa' => User::where('role', 'mahasiswa')->count(),
            'totalMataKuliah' => MataKuliah::count(),
            'totalKelas' => Kelas::count(),
            'totalSesi' => SesiMentoring::count(),
        ];

        return view('admin.dashboard', $data);
    }
}
