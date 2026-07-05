<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class AktivitasController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(50);
        return view('admin.aktivitas', compact('logs'));
    }
}
