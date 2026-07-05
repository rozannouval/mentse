<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SesiMentoring;

class SesiMentoringSeeder extends Seeder
{
    public function run(): void
    {
        SesiMentoring::create([
            'kelas_id' => 1,
            'topik' => 'Pengenalan Laravel',
            'deskripsi' => 'Belajar dasar-dasar Laravel untuk pemula',
            'tanggal' => '2026-07-20',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:00',
            'kuota' => 5,
            'status' => 'dibuka',
        ]);

        SesiMentoring::create([
            'kelas_id' => 1,
            'topik' => 'Eloquent ORM',
            'deskripsi' => 'Belajar Eloquent ORM Laravel',
            'tanggal' => '2026-07-25',
            'jam_mulai' => '13:00',
            'jam_selesai' => '15:00',
            'kuota' => 5,
            'status' => 'dibuka',
        ]);

        SesiMentoring::create([
            'kelas_id' => 2,
            'topik' => 'CRUD Laravel',
            'deskripsi' => 'Belajar membuat CRUD dengan Laravel',
            'tanggal' => '2026-07-22',
            'jam_mulai' => '13:00',
            'jam_selesai' => '15:00',
            'kuota' => 5,
            'status' => 'dibuka',
        ]);

        SesiMentoring::create([
            'kelas_id' => 3,
            'topik' => 'Binary Search Tree',
            'deskripsi' => 'Pembahasan BST dan implementasinya',
            'tanggal' => '2026-07-10',
            'jam_mulai' => '10:00',
            'jam_selesai' => '12:00',
            'kuota' => 5,
            'status' => 'selesai',
        ]);
    }
}
