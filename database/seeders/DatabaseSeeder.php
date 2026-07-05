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

        User::where('nim', '220101001')->update(['kelas_id' => 1]);
        User::where('nim', '220101002')->update(['kelas_id' => 1]);
        User::where('nim', '220101003')->update(['kelas_id' => 2]);
        User::where('nim', '220101004')->update(['kelas_id' => 2]);
        User::where('nim', '220101005')->update(['kelas_id' => 3]);

        $this->call([
            PesertaKelasSeeder::class,
            SesiMentoringSeeder::class,
            PesertaSesiSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}
