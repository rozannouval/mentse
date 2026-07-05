<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesertaSesi;
use Illuminate\Support\Facades\Auth;

class PesertaSesiController extends Controller
{
    public function index()
    {
        return view('student.sessions');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sesi_id' => 'required',
        ]);

        PesertaSesi::create([
            'sesi_id' => $request->sesi_id,
            'mahasiswa_id' => Auth::id(),
            'status' => 'terdaftar',
        ]);

        return redirect()->route('student.history');
    }

    public function history()
    {
        return view('student.history');
    }
}
