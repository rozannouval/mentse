<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::create([
            'nama_kelas' => 'TI-A',
            'mata_kuliah_id' => 1,
            'dosen_id' => 2,
            'mentor_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'TI-B',
            'mata_kuliah_id' => 2,
            'dosen_id' => 2,
            'mentor_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'TI-C',
            'mata_kuliah_id' => 3,
            'dosen_id' => 2,
            'mentor_id' => 3,
        ]);

        Kelas::create([
            'nama_kelas' => 'TI-D',
            'mata_kuliah_id' => 3,
            'dosen_id' => 1,
            'mentor_id' => 1,
        ]);
    }
}