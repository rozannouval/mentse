<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PesertaSesi;

class PesertaSesiSeeder extends Seeder
{
    public function run(): void
    {
        PesertaSesi::create([
            'sesi_id'=>1,
            'mahasiswa_id'=>4,
            'status'=>'hadir'
        ]);

        PesertaSesi::create([
            'sesi_id'=>1,
            'mahasiswa_id'=>5,
            'status'=>'terdaftar'
        ]);
    }
}