<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiMentoring extends Model
{
    protected $fillable = [
        'kelas_id',
        'topik',
        'deskripsi',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'kuota',
        'status',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function pesertaSesi()
    {
        return $this->hasMany(PesertaSesi::class, 'sesi_id');
    }

    public function pesertaHadir()
    {
        return $this->hasMany(PesertaSesi::class, 'sesi_id')->where('status', 'hadir');
    }
}
