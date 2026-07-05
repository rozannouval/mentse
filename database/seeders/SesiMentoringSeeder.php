<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SesiMentoring;

class SesiMentoringSeeder extends Seeder
{
    public function run(): void
    {
        SesiMentoring::create(['kelas_id' => 1, 'topik' => 'Pengenalan Laravel', 'deskripsi' => 'Belajar dasar-dasar Laravel untuk pemula', 'tanggal' => '2026-07-20', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'kuota' => 5, 'status' => 'dibuka']);
        SesiMentoring::create(['kelas_id' => 1, 'topik' => 'Eloquent ORM', 'deskripsi' => 'Belajar Eloquent ORM Laravel', 'tanggal' => '2026-07-25', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'kuota' => 5, 'status' => 'dibuka']);
        SesiMentoring::create(['kelas_id' => 1, 'topik' => 'CRUD Laravel', 'deskripsi' => 'Belajar membuat CRUD dengan Laravel', 'tanggal' => '2026-08-05', 'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'kuota' => 5, 'status' => 'dibuka']);
    }
}
