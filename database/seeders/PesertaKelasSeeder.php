<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PesertaKelas;

class PesertaKelasSeeder extends Seeder
{
    public function run(): void
    {
        PesertaKelas::create(['kelas_id' => 1, 'mahasiswa_id' => 6]);
        PesertaKelas::create(['kelas_id' => 1, 'mahasiswa_id' => 7]);
        PesertaKelas::create(['kelas_id' => 2, 'mahasiswa_id' => 8]);
        PesertaKelas::create(['kelas_id' => 2, 'mahasiswa_id' => 9]);
        PesertaKelas::create(['kelas_id' => 3, 'mahasiswa_id' => 10]);
        PesertaKelas::create(['kelas_id' => 3, 'mahasiswa_id' => 6]);
        PesertaKelas::create(['kelas_id' => 4, 'mahasiswa_id' => 7]);
        PesertaKelas::create(['kelas_id' => 4, 'mahasiswa_id' => 8]);
    }
}
