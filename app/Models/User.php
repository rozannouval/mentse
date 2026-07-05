<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'photo',
        'nim',
        'nidn',
        'password',
        'role',
        'kelas_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kelasDosen()
    {
        return $this->hasMany(Kelas::class, 'dosen_id');
    }

    public function kelasMentor()
    {
        return $this->hasMany(Kelas::class, 'mentor_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function pesertaKelas()
    {
        return $this->belongsToMany(Kelas::class, 'peserta_kelas', 'mahasiswa_id', 'kelas_id');
    }

    public function pesertaSesi()
    {
        return $this->hasMany(PesertaSesi::class, 'mahasiswa_id');
    }
}
