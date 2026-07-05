<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        MataKuliah::create([
            'nama_mata_kuliah' => 'Pemrograman Web II'
        ]);

        MataKuliah::create([
            'nama_mata_kuliah' => 'Sistem Basis Data'
        ]);

        MataKuliah::create([
            'nama_mata_kuliah' => 'Struktur Data'
        ]);

        MataKuliah::create([
            'nama_mata_kuliah' => 'Sistem Informasi'
        ]);

        MataKuliah::create([
            'nama_mata_kuliah' => 'Sistem Operasi'
        ]);

        MataKuliah::create([
            'nama_mata_kuliah' => 'Jaringan Komputer'
        ]);

    }
}