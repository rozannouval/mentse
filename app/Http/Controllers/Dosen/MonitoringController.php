<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function index()
    {
        $dosen = Auth::user();
        $kelasList = $dosen->kelasDosen()->with(['mataKuliah', 'mentor', 'sesiMentoring.pesertaSesi.mahasiswa', 'sesiMentoring.pesertaSesi.feedback'])->get();

        $allSesi = $kelasList->flatMap(fn($k) => $k->sesiMentoring);
        $totalSesi = $allSesi->count();
        $totalHadir = $allSesi->sum(fn($s) => $s->pesertaSesi->where('status', 'hadir')->count());
        $totalFeedback = $allSesi->sum(fn($s) => $s->pesertaSesi->sum(fn($ps) => $ps->feedback ? 1 : 0));

        return view('dosen.monitoring', compact('kelasList', 'allSesi', 'totalSesi', 'totalHadir', 'totalFeedback'));
    }
}
