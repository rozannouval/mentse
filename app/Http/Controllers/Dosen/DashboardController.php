<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Dosen yang sedang login
        $dosen = Auth::user();

        // Ambil seluruh kelas yang diampu beserta relasinya
        $kelasList = $dosen->kelasDosen()
            ->with([
                'mataKuliah',
                'mentor',
                'sesiMentoring.pesertaSesi'
            ])
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Statistik Dashboard
        |--------------------------------------------------------------------------
        */

        // Jumlah kelas
        $totalKelas = $kelasList->count();

        // Jumlah seluruh sesi mentoring
        $totalSesi = 0;

        // Jumlah kelas yang belum memiliki mentor
        $kelasTanpaMentor = 0;

        // Jumlah seluruh peserta sesi
        $totalPeserta = 0;

        // Jumlah sesi yang masih dibuka
        $sesiAktif = 0;

        foreach ($kelasList as $kelas) {

            // Hitung jumlah sesi
            $totalSesi += $kelas->sesiMentoring->count();

            // Hitung kelas tanpa mentor
            if (!$kelas->mentor_id) {
                $kelasTanpaMentor++;
            }

            foreach ($kelas->sesiMentoring as $sesi) {

                // Total peserta
                $totalPeserta += $sesi->pesertaSesi->count();

                // Total sesi aktif
                if ($sesi->status === 'dibuka') {
                    $sesiAktif++;
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Total Feedback
        |--------------------------------------------------------------------------
        */

        $totalFeedback = Feedback::whereHas(
            'pesertaSesi.sesi.kelas',
            function ($query) use ($dosen) {
                $query->where('dosen_id', $dosen->id);
            }
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Feedback Terbaru
        |--------------------------------------------------------------------------
        */

        $kelasIds = $kelasList->pluck('id');

        $recentFeedback = Feedback::whereHas(
            'pesertaSesi.sesi.kelas',
            function ($query) use ($kelasIds) {
                $query->whereIn('id', $kelasIds);
            }
        )
            ->with([
                'pesertaSesi.mahasiswa',
                'pesertaSesi.sesi.kelas'
            ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view('dosen.dashboard', compact(
            'kelasList',
            'totalKelas',
            'totalSesi',
            'kelasTanpaMentor',
            'totalPeserta',
            'sesiAktif',
            'totalFeedback',
            'recentFeedback'
        ));
    }
}
