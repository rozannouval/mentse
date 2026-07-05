<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::create(['nama_kelas' => 'D2025', 'mata_kuliah_id' => 1, 'dosen_id' => 2, 'mentor_id' => 4]);
        Kelas::create(['nama_kelas' => 'A2025', 'mata_kuliah_id' => 2, 'dosen_id' => 3, 'mentor_id' => 5]);
        Kelas::create(['nama_kelas' => 'D2023', 'mata_kuliah_id' => 3, 'dosen_id' => 3, 'mentor_id' => 10]);
    }
}
