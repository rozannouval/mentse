@extends('layouts.mahasiswa')
@section('title', 'Isi Feedback')

@section('content')
<div class="flex justify-center py-6 px-4">
    <div class="bg-white shadow-sm border border-gray-100 p-6 rounded-xl max-w-lg w-full">
        <h4 class="text-xl font-bold text-emerald-700 mb-1">Form Evaluasi Mentoring</h4>
        <p class="text-gray-500 text-xs mb-5">Silakan bagikan pengalaman belajarmu untuk membantu meningkatkan kualitas mentoring berikutnya.</p>

        <div class="p-4 mb-5 bg-emerald-50 rounded-lg border-l-4 border-emerald-600">
            <strong class="text-gray-800 text-sm">{{ $pesertaSesi->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</strong>
            <p class="text-gray-500 text-xs mt-1">{{ $pesertaSesi->sesi->topik ?? '-' }}</p>
            <p class="text-gray-500 text-xs">Mentor: {{ $pesertaSesi->sesi->kelas->mentor->name ?? '-' }} • {{ \Carbon\Carbon::parse($pesertaSesi->sesi->tanggal)->format('d M Y') }}</p>
        </div>

        <form action="{{ route('mahasiswa.feedback.store', $pesertaSesi) }}" method="POST">
            @csrf
            <input type="hidden" name="peserta_sesi_id" value="{{ $pesertaSesi->id }}">

            <p class="font-bold text-xs text-gray-700 mb-4 tracking-wide">ASPEK PENILAIAN MENTOR</p>

            <div class="mb-4 pb-3 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-semibold text-gray-500">1. Komunikasi Mentor</label>
                    <input type="hidden" name="komunikasi" id="input-komunikasi" value="0" required>
                    <div class="flex space-x-1 text-gray-300 text-xl rating-container" data-target="input-komunikasi">
                        @for ($i = 1; $i <= 5; $i++)
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="{{ $i }}">★</span>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="mb-4 pb-3 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-semibold text-gray-500">2. Penguasaan Materi</label>
                    <input type="hidden" name="penguasaan_materi" id="input-materi" value="0" required>
                    <div class="flex space-x-1 text-gray-300 text-xl rating-container" data-target="input-materi">
                        @for ($i = 1; $i <= 5; $i++)
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="{{ $i }}">★</span>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="mb-5 pb-3 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-semibold text-gray-500">3. Kejelasan Penyampaian</label>
                    <input type="hidden" name="kejelasan_penyampaian" id="input-penyampaian" value="0" required>
                    <div class="flex space-x-1 text-gray-300 text-xl rating-container" data-target="input-penyampaian">
                        @for ($i = 1; $i <= 5; $i++)
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="{{ $i }}">★</span>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-700 mb-2">Komentar / Ulasan Tambahan</label>
                <textarea class="w-full text-xs p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 bg-gray-50/50" name="komentar" rows="4" placeholder="Tulis kritik, saran, atau ulasan tambahan..." required></textarea>
            </div>

            <div class="flex justify-between items-center mt-5">
                <a href="{{ route('mahasiswa.riwayat') }}" class="text-xs text-gray-400 hover:text-gray-600 transition-colors">Kembali</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg text-xs font-semibold transition-colors shadow-sm cursor-pointer">
                    Simpan Feedback
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.rating-container').forEach(container => {
        const stars = container.querySelectorAll('span');
        const targetInput = document.getElementById(container.getAttribute('data-target'));
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = star.getAttribute('data-value');
                targetInput.value = value;
                stars.forEach(s => {
                    if (s.getAttribute('data-value') <= value) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-amber-400');
                    } else {
                        s.classList.remove('text-amber-400');
                        s.classList.add('text-gray-300');
                    }
                });
            });
        });
    });
</script>
@endsection
