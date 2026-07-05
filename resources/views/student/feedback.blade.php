@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[85vh] py-6 px-4">
    
    <div class="bg-white shadow-sm border border-gray-100 p-6 rounded-xl max-w-[650px] w-full">
        
        <h4 class="text-xl font-bold text-[#004d40] mb-1">📝 Form Evaluasi Mentoring</h4>
        <p class="text-gray-500 text-xs mb-5">Silakan bagikan pengalaman belajarmu untuk membantu meningkatkan kualitas mentoring berikutnya.</p>
        
        <div class="p-4 mb-5 bg-[#e0f2f1] rounded-lg border-l-4 border-[#00796b]">
            <div class="flex justify-between items-center">
                <strong class="text-gray-800 text-sm">Struktur Data & Algoritma</strong>
                <span class="bg-white text-gray-500 text-[10px] px-2 py-0.5 rounded border border-gray-200 font-medium">Selesai</span>
            </div>
            <p class="text-gray-500 text-xs mt-1">Mentor: Dr. Budi Santoso • 18 Nov 2023</p>
        </div>
        
        <form action="{{ route('student.feedback.store') }}" method="POST">
            @csrf
            <input type="hidden" name="peserta_sesi_id" value="1">
            
            <p class="font-bold text-xs text-gray-700 mb-4 tracking-wide">⭐ ASPEK PENILAIAN MENTOR</p>
          
            <div class="mb-4 pb-3 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-semibold text-gray-500">1. Penilaian Komunikasi Mentor</label>
                    <input type="hidden" name="komunikasi" id="input-komunikasi" value="0" required>
                    <div class="flex space-x-1 text-gray-300 text-xl rating-container" data-target="input-komunikasi">
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="1">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="2">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="3">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="4">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="5">★</span>
                    </div>
                </div>
            </div>

            <div class="mb-4 pb-3 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-semibold text-gray-500">2. Penguasaan Materi oleh Mentor</label>
                    <input type="hidden" name="penguasaan_materi" id="input-materi" value="0" required>
                    <div class="flex space-x-1 text-gray-300 text-xl rating-container" data-target="input-materi">
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="1">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="2">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="3">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="4">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="5">★</span>
                    </div>
                </div>
            </div>

            <div class="mb-5 pb-3 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <label class="text-xs font-semibold text-gray-500">3. Kejelasan Penyampaian Materi</label>
                    <input type="hidden" name="kejelasan_penyampaian" id="input-penyampaian" value="0" required>
                    <div class="flex space-x-1 text-gray-300 text-xl rating-container" data-target="input-penyampaian">
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="1">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="2">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="3">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="4">★</span>
                        <span class="cursor-pointer hover:text-amber-400 transition-colors" data-value="5">★</span>
                    </div>
                </div>
            </div>
            
            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-700 mb-2">📝 Tulis Komentar / Ulasan Tambahan</label>
                <textarea class="w-full text-xs p-3 border border-gray-200 rounded-lg focus:outline-none focus:border-[#004d40] focus:ring-1 focus:ring-[#004d40] bg-gray-50/50" name="komentar" rows="4" placeholder="Tulis kritik, saran, atau ulasan tambahan untuk mentor di sini..." required></textarea>
            </div>
   
            <div class="flex justify-between items-center mt-5">
                <a href="{{ route('student.dashboard') }}" class="text-xs text-gray-400 hover:text-gray-600 transition-colors">Kembali</a>
                <button type="submit" class="bg-[#004d40] hover:bg-[#00332c] text-white px-5 py-2 rounded-lg text-xs font-semibold transition-colors shadow-sm">
                    Simpan & Kunci Feedback
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