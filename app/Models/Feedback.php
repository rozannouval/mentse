<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'peserta_sesi_id',
        'komunikasi',
        'penguasaan_materi',
        'kejelasan_penyampaian',
        'komentar'
    ];
}
