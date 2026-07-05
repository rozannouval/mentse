<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = [
        'nama_mata_kuliah',
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'mata_kuliah_id');
    }
}
