<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        Feedback::create([
            'peserta_sesi_id' => 1,
            'komunikasi' => 5,
            'penguasaan_materi' => 5,
            'kejelasan_penyampaian' => 5,
            'komentar' => 'Mentoring sangat membantu. Penjelasan mudah dipahami.',
        ]);
    }
}
