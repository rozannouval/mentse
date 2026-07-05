<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PesertaSesi;

class PesertaSesiSeeder extends Seeder
{
    public function run(): void
    {
        PesertaSesi::create(['sesi_id' => 1, 'mahasiswa_id' => 6, 'status' => 'hadir']);
        PesertaSesi::create(['sesi_id' => 1, 'mahasiswa_id' => 7, 'status' => 'terdaftar']);
        PesertaSesi::create(['sesi_id' => 4, 'mahasiswa_id' => 10, 'status' => 'hadir']);
        PesertaSesi::create(['sesi_id' => 4, 'mahasiswa_id' => 9, 'status' => 'tidak_hadir']);
        PesertaSesi::create(['sesi_id' => 6, 'mahasiswa_id' => 8, 'status' => 'terdaftar']);
        PesertaSesi::create(['sesi_id' => 6, 'mahasiswa_id' => 9, 'status' => 'terdaftar']);
    }
}
