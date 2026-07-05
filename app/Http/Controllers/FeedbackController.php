<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('student.feedback');
    }

    public function store(Request $request)
    {
        $request->validate([
            'peserta_sesi_id' => 'required',
            'komunikasi' => 'required|integer|min:1|max:5',
            'penguasaan_materi' => 'required|integer|min:1|max:5',
            'kejelasan_penyampaian' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string',
        ]);

        Feedback::create([
            'peserta_sesi_id' => $request->peserta_sesi_id,
            'komunikasi' => $request->komunikasi,
            'penguasaan_materi' => $request->penguasaan_materi,
            'kejelasan_penyampaian' => $request->kejelasan_penyampaian,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('student.history');
    }
}
