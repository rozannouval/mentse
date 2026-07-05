<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::create(['nama_kelas' => 'D2024', 'mata_kuliah_id' => 1, 'dosen_id' => 2, 'mentor_id' => 4]);
        Kelas::create(['nama_kelas' => 'B2024', 'mata_kuliah_id' => 1, 'dosen_id' => 2, 'mentor_id' => 5]);
        Kelas::create(['nama_kelas' => 'A2025', 'mata_kuliah_id' => 2, 'dosen_id' => 3, 'mentor_id' => 5]);
        Kelas::create(['nama_kelas' => 'D2025', 'mata_kuliah_id' => 3, 'dosen_id' => 3, 'mentor_id' => null]);
        Kelas::create(['nama_kelas' => 'C2024', 'mata_kuliah_id' => 4, 'dosen_id' => 2, 'mentor_id' => null]);
    }
}
