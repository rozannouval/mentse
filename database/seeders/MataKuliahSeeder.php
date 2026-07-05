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
            'nama_mata_kuliah' => 'Pemrograman Java Lanjutan'
        ]);

        MataKuliah::create([
            'nama_mata_kuliah' => 'Internet of Things'
        ]);

        MataKuliah::create([
            'nama_mata_kuliah' => 'Programming Berorientasi Objek'
        ]);

    }
}