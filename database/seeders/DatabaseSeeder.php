<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MataKuliahSeeder::class,
            KelasSeeder::class,
        ]);

        $this->call([
            PesertaKelasSeeder::class,
            SesiMentoringSeeder::class,
            PesertaSesiSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}
