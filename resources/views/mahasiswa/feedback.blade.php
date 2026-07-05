@extends('layouts.mahasiswa')
@section('title', 'Isi Feedback')
@section('active', 'mahasiswa.riwayat')

@section('content')
<div class="max-w-2xl mx-auto">
    <x-card title="Form Evaluasi Mentoring">
        <p class="text-sm text-gray-500 mb-6">Silakan bagikan pengalaman belajarmu untuk membantu meningkatkan kualitas mentoring.</p>

        <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 mb-6">
            <p class="font-semibold text-gray-900">{{ $pesertaSesi->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
            <p class="text-sm text-gray-600 mt-0.5">{{ $pesertaSesi->sesi->topik ?? '-' }}</p>
            <p class="text-xs text-gray-500 mt-1">
                Mentor: {{ $pesertaSesi->sesi->kelas->mentor->name ?? '-' }} &middot;
                {{ \Carbon\Carbon::parse($pesertaSesi->sesi->tanggal)->format('d M Y') }}
            </p>
        </div>

        <form action="{{ route('mahasiswa.feedback.store', $pesertaSesi) }}" method="POST">
            @csrf

            <p class="text-sm font-semibold text-gray-700 mb-4">Aspek Penilaian Mentor</p>

            <div class="space-y-5">
                @php $fields = [
                    'komunikasi' => 'Komunikasi Mentor',
                    'penguasaan_materi' => 'Penguasaan Materi',
                    'kejelasan_penyampaian' => 'Kejelasan Penyampaian',
                ]; @endphp

                @foreach ($fields as $key => $label)
                <div class="flex items-center justify-between py-3 border-b border-gray-100">
                    <label class="text-sm font-medium text-gray-700">{{ $loop->iteration }}. {{ $label }}</label>
                    <div class="flex items-center gap-1">
                        <input type="hidden" name="{{ $key }}" id="input-{{ $key }}" value="0" required>
                        <div class="rating-container flex gap-0.5 text-2xl text-gray-200" data-target="input-{{ $key }}">
                            @for ($i = 1; $i <= 5; $i++)
                            <span class="cursor-pointer hover:text-amber-400 transition-colors duration-150" data-value="{{ $i }}">★</span>
                            @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-5">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Komentar / Ulasan Tambahan</label>
                <textarea name="komentar" rows="4" required
                    class="block w-full rounded-lg border border-gray-300 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200"
                    placeholder="Tulis kritik, saran, atau ulasan tambahan untuk mentor..."></textarea>
            </div>

            <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                <a href="{{ route('mahasiswa.riwayat') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium">Kembali</a>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm shadow-emerald-600/20 cursor-pointer">
                    Kirim Feedback
                </button>
            </div>
        </form>
    </x-card>
</div>

<script>
document.querySelectorAll('.rating-container').forEach(container => {
    const stars = container.querySelectorAll('span');
    const targetInput = document.getElementById(container.getAttribute('data-target'));
    stars.forEach(star => {
        star.addEventListener('click', () => {
            const value = parseInt(star.getAttribute('data-value'));
            targetInput.value = value;
            stars.forEach(s => {
                const sv = parseInt(s.getAttribute('data-value'));
                if (sv <= value) {
                    s.classList.remove('text-gray-200');
                    s.classList.add('text-amber-400');
                } else {
                    s.classList.remove('text-amber-400');
                    s.classList.add('text-gray-200');
                }
            });
        });
    });
});
</script>
@endsection
