@extends('layouts.mahasiswa')
@section('title', 'Isi Feedback')
@section('active', 'mahasiswa.riwayat')

@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h2 class="text-[15px] font-semibold text-gray-900 mb-1">Evaluasi Mentoring</h2>
        <p class="text-sm text-gray-500 mb-6">Bantu kami meningkatkan kualitas mentoring dengan penilaian jujur Anda.</p>

        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <p class="font-medium text-gray-900">{{ $pesertaSesi->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}</p>
            <p class="text-sm text-gray-600 mt-0.5">{{ $pesertaSesi->sesi->topik ?? '-' }}</p>
            <p class="text-xs text-gray-500 mt-1">
                Mentor: {{ $pesertaSesi->sesi->kelas->mentor->name ?? '-' }}
                &middot; {{ \Carbon\Carbon::parse($pesertaSesi->sesi->tanggal)->format('d M Y') }}
            </p>
        </div>

        <form action="{{ route('mahasiswa.feedback.store', $pesertaSesi) }}" method="POST">
            @csrf

            <div class="space-y-5 mb-6">
                @php $fields = [
                    'komunikasi' => 'Komunikasi',
                    'penguasaan_materi' => 'Penguasaan Materi',
                    'kejelasan_penyampaian' => 'Kejelasan Penyampaian',
                ]; @endphp

                @foreach ($fields as $key => $label)
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-2">{{ $loop->iteration }}. {{ $label }}</p>
                    <input type="hidden" name="{{ $key }}" id="input-{{ $key }}" value="0" required>
                    <div class="rating-container flex gap-1 text-xl text-gray-200" data-target="input-{{ $key }}">
                        @for ($i = 1; $i <= 5; $i++)
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="{{ $i }}">★</span>
                        @endfor
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Komentar</label>
                <textarea name="komentar" rows="3" required
                    class="block w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-gray-400 transition-colors"
                    placeholder="Kesan dan saran untuk mentor..."></textarea>
            </div>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('mahasiswa.riwayat') }}" class="text-sm text-gray-500 hover:text-gray-700">Kembali</a>
                <button type="submit" class="px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors cursor-pointer">
                    Kirim Feedback
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