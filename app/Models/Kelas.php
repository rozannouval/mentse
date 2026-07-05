<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'nama_kelas',
        'mata_kuliah_id',
        'dosen_id',
        'mentor_id',
    ];

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function pesertaKelas()
    {
        return $this->hasMany(PesertaKelas::class, 'kelas_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(User::class, 'kelas_id')->where('role', 'mahasiswa');
    }

    public function sesiMentoring()
    {
        return $this->hasMany(SesiMentoring::class, 'kelas_id');
    }
}
