<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\SesiMentoring;
use App\Models\PesertaSesi;
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

        $sesiMendatang = SesiMentoring::whereHas('kelas', function ($q) use ($mentor) {
            $q->where('mentor_id', $mentor->id);
        })->whereDate('tanggal', '>=', now())->orderBy('tanggal')->get();

        return view('mentor.dashboard', compact('kelasList', 'totalSesi', 'totalPeserta', 'sesiMendatang'));
    }
}
