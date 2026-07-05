<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Administrator', 'email' => 'admin@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'admin']);
        User::create(['name' => 'Ahfi Fauka Pranata, S. Kom., M.M.', 'email' => 'dosen1@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'dosen', 'nidn' => '1234567890']);
        User::create(['name' => 'Ahmad Fauzi, S.Kom.', 'email' => 'dosen2@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'dosen', 'nidn' => '0987654321']);
        User::create(['name' => 'Rozan Nauval', 'email' => 'mentor1@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'mentor']);
        User::create(['name' => 'Muhammad Eka', 'email' => 'mentor2@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'mentor']);
        User::create(['name' => 'Nadza Rizqi', 'email' => 'nadza@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'mahasiswa', 'nim' => '220101001']);
        User::create(['name' => 'Tania Nurhasanah', 'email' => 'tania@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'mahasiswa', 'nim' => '220101002']);
        User::create(['name' => 'Nadzira', 'email' => 'nadzira@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'mahasiswa', 'nim' => '220101003']);
        User::create(['name' => 'Nauval', 'email' => 'nauval@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'mahasiswa', 'nim' => '220101004']);
        User::create(['name' => 'Gunawan', 'email' => 'gunawan@gmail.com', 'password' => Hash::make('12345678'), 'role' => 'mahasiswa', 'nim' => '220101005']);
    }
}
