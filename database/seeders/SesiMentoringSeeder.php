<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SesiMentoring;

class SesiMentoringSeeder extends Seeder
{
    public function run(): void
    {
        SesiMentoring::create([
            'kelas_id'=>1,
            'topik'=>'Pengenalan Laravel',
            'deskripsi'=>'Belajar dasar Laravel',
            'tanggal'=>'2026-07-20',
            'jam_mulai'=>'08:00',
            'jam_selesai'=>'10:00',
            'kuota'=>20,
            'status'=>'dibuka'
        ]);

        SesiMentoring::create([
            'kelas_id'=>2,
            'topik'=>'CRUD Laravel',
            'deskripsi'=>'Belajar CRUD',
            'tanggal'=>'2026-07-22',
            'jam_mulai'=>'13:00',
            'jam_selesai'=>'15:00',
            'kuota'=>25,
            'status'=>'dibuka'
        ]);
    }
}