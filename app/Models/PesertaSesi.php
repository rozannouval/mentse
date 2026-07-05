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
        'status'
    ];
}
