<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Helpers\ActivityLogger;
use App\Http\Controllers\Controller;
use App\Models\SesiMentoring;
use App\Models\PesertaSesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user();

        $sesiList = SesiMentoring::where('kelas_id', $mahasiswa->kelas_id)
            ->where('status', 'dibuka')
            ->with(['kelas.mataKuliah', 'kelas.mentor', 'pesertaSesi'])
            ->orderBy('tanggal')
            ->get();

        $sesiDiikuti = $mahasiswa->pesertaSesi()->with(['sesi.kelas.mataKuliah'])->get();

        return view('mahasiswa.sesi', compact('sesiList', 'sesiDiikuti'));
    }

    public function daftar(SesiMentoring $sesi)
    {
        $mahasiswa = Auth::user();

        if ($mahasiswa->kelas_id !== $sesi->kelas_id) {
            return back()->with('error', 'Anda tidak terdaftar di kelas sesi ini.');
        }

        $sudahDaftar = PesertaSesi::where('sesi_id', $sesi->id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->exists();
        if ($sudahDaftar) {
            return back()->with('error', 'Anda sudah terdaftar di sesi ini.');
        }

        $jumlahPeserta = PesertaSesi::where('sesi_id', $sesi->id)->count();
        if ($jumlahPeserta >= $sesi->kuota) {
            return back()->with('error', 'Kuota sesi sudah penuh.');
        }

        PesertaSesi::create([
            'sesi_id' => $sesi->id,
            'mahasiswa_id' => $mahasiswa->id,
            'status' => 'terdaftar',
        ]);

        ActivityLogger::log('Daftar Sesi', "Mahasiswa {$mahasiswa->name} mendaftar sesi {$sesi->topik}");

        return redirect()->route('mahasiswa.riwayat')->with('success', 'Berhasil mendaftar sesi mentoring.');
    }

    public function batalkan(PesertaSesi $pesertaSesi)
    {
        $mahasiswa = Auth::user();

        if ($pesertaSesi->mahasiswa_id !== $mahasiswa->id) {
            abort(403);
        }

        if ($pesertaSesi->status !== 'terdaftar') {
            return back()->with('error', 'Pendaftaran tidak dapat dibatalkan karena sesi sudah berlangsung/selesai.');
        }

        $topik = $pesertaSesi->sesi->topik ?? 'Sesi Mentoring';
        $pesertaSesi->delete();

        ActivityLogger::log('Batalkan Sesi', "Mahasiswa {$mahasiswa->name} membatalkan pendaftaran sesi {$topik}");

        return back()->with('success', 'Pendaftaran sesi berhasil dibatalkan.');
    }

    public function riwayat()
    {
        $riwayatSesi = Auth::user()->pesertaSesi()
            ->with(['sesi.kelas.mataKuliah', 'feedback'])
            ->latest()
            ->get();

        return view('mahasiswa.riwayat', compact('riwayatSesi'));
    }
}
