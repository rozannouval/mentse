<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PesertaKelas;

class PesertaKelasSeeder extends Seeder
{
    public function run(): void
    {
        PesertaKelas::create([
            'kelas_id'=>1,
            'mahasiswa_id'=>4
        ]);

        PesertaKelas::create([
            'kelas_id'=>1,
            'mahasiswa_id'=>5
        ]);
    }
}