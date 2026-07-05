@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-[#004d40]">📋 Daftar Sesi Mentoring Tersedia</h3>
        <p class="text-gray-500 text-xs mt-1">Pilih jadwal bimbingan belajar bersama mentor pilihanmu sebelum kuota penuh.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col justify-between h-full">
            <div>
                <div class="flex justify-between items-center mb-3">
                    <span class="bg-[#e0f2f1] text-[#00796b] text-[10px] font-bold px-2 py-1 rounded">TEKNIK INFORMATIKA</span>
                    <span class="bg-green-500 text-white text-[10px] font-semibold px-2 py-0.5 rounded-md">Dibuka</span>
                </div>
                <h5 class="text-base font-bold text-[#004d40] mb-1">Pemrograman Web II</h5>
                <p class="text-gray-500 text-xs mb-4">Topik: Pembahasan Lanjutan React Hooks & Context API untuk State Management.</p>
                
                <div class="text-gray-500 text-xs space-y-2 border-t border-gray-100 pt-3 mb-5 leading-relaxed">
                    <div>🕒 <span class="font-bold text-gray-700">Waktu:</span> Hari ini, 14:00 - 15:30 WIB</div>
                    <div>👤 <span class="font-bold text-gray-700">Mentor:</span> Budi Santoso</div>
                    <div class="text-green-600 font-semibold">👥 <span class="font-bold">Kuota:</span> 3 / 10 Peserta (Tersedia)</div>
                </div>
            </div>

            <form action="{{ route('student.sessions.store') }}" method="POST" class="mt-auto">
                @csrf
                <input type="hidden" name="sesi_id" value="1">
                <button type="submit" class="w-full bg-[#004d40] hover:bg-[#00332c] text-white text-center py-2 rounded-lg font-medium text-xs transition-colors">
                    Daftar Sesi Sekarang
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex flex-col justify-between h-full opacity-80">
            <div>
                <div class="flex justify-between items-center mb-3">
                    <span class="bg-[#fefeeb] text-[#f57f17] text-[10px] font-bold px-2 py-1 rounded">SISTEM INFORMASI</span>
                    <span class="bg-red-500 text-white text-[10px] font-semibold px-2 py-0.5 rounded-md">Penuh</span>
                </div>
                <h5 class="text-base font-bold text-gray-500 mb-1">Analisis & Desain Sistem</h5>
                <p class="text-gray-400 text-xs mb-4">Topik: Pembuatan Use Case Diagram dan Activity Diagram praktis secara detail.</p>
                
                <div class="text-gray-400 text-xs space-y-2 border-t border-gray-100 pt-3 mb-5 leading-relaxed">
                    <div>🕒 <span class="font-bold text-gray-500">Waktu:</span> Besok, 10:00 - 11:30 WIB</div>
                    <div>👤 <span class="font-bold text-gray-500">Mentor:</span> Siti Aminah</div>
                    <div class="text-danger font-bold">👥 <span class="font-bold">Kuota:</span> 15 / 15 Peserta (Penuh)</div>
                </div>
            </div>

            <button class="w-full bg-gray-300 text-gray-500 py-2 rounded-lg font-medium text-xs cursor-not-allowed mt-auto" disabled>
                Kuota Penuh
            </button>
        </div>

    </div>
</div>
@endsection