<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $dosen = Auth::user();
        $kelasList = $dosen->kelasDosen()->with(['mataKuliah', 'mentor', 'sesiMentoring'])->get();

        $totalKelas = $kelasList->count();
        $totalSesi = $kelasList->sum(fn($k) => $k->sesiMentoring->count());
        $kelasTanpaMentor = $kelasList->filter(fn($k) => !$k->mentor_id)->count();

        return view('dosen.dashboard', compact('kelasList', 'totalKelas', 'totalSesi', 'kelasTanpaMentor'));
    }
}
