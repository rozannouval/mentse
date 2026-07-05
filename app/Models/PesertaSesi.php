<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaSesi extends Model
{
    use HasFactory;

    protected $table = 'peserta_sesis';

    protected $fillable = [
        'sesi_id',
        'mahasiswa_id',
        'status',
    ];

    public function sesi()
    {
        return $this->belongsTo(SesiMentoring::class, 'sesi_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'peserta_sesi_id');
    }

    public function scopeHadir($query)
    {
        return $query->where('status', 'hadir');
    }
}
