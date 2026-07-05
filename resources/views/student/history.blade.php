@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h3 class="text-2xl font-bold text-[#004d40]">📊 Riwayat Belajar</h3>
            <p class="text-gray-500 text-xs mt-1">Pantau kehadiran dan rekapitulasi sesi mentoring yang pernah kamu ikuti.</p>
        </div>
        <a href="{{ route('student.dashboard') }}" class="inline-block border border-gray-300 hover:bg-gray-50 text-gray-600 text-xs font-medium px-4 py-2 rounded-lg transition-colors">
            Kembali ke Beranda
        </a>
    </div>

    <div class="bg-white shadow-sm border border-gray-100 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
               
                <thead class="bg-[#004d40] text-white text-xs uppercase tracking-wider">
                    <tr>
                        <th class="p-4 font-semibold">Mata Kuliah</th>
                        <th class="p-4 font-semibold">Topik Sesi</th>
                        <th class="p-4 font-semibold">Mentor</th>
                        <th class="p-4 font-semibold">Tanggal & Waktu</th>
                        <th class="p-4 font-semibold">Status Kehadiran</th>
                        <th class="p-4 font-semibold text-center">Aksi / Evaluasi</th>
                    </tr>
                </thead>
               
                <tbody class="divide-y divide-gray-100 text-sm">
                  
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="p-4 font-semibold text-gray-800">Pemrograman Web II</td>
                        <td class="p-4 text-gray-500 text-xs">React Hooks & Context API</td>
                        <td class="p-4 text-gray-600">Budi Santoso</td>
                        <td class="p-4 text-gray-500 text-xs">04 Jul 2026 • 14:00</td>
                        <td class="p-4">
                            <span class="bg-green-50 text-green-700 text-xs font-medium px-2.5 py-1 rounded-md">Hadir</span>
                        </td>
                        <td class="p-4 text-center">
                            <a href="{{ route('student.feedback') }}" class="inline-block bg-[#00796b] hover:bg-[#005b51] text-white text-xs font-medium px-3 py-1.5 rounded-md transition-colors shadow-sm">
                                📝 Isi Feedback
                            </a>
                        </td>
                    </tr>
                    
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="p-4 font-semibold text-gray-800">Analisis & Desain Sistem</td>
                        <td class="p-4 text-gray-500 text-xs">Use Case & Activity Diagram</td>
                        <td class="p-4 text-gray-600">Siti Aminah</td>
                        <td class="p-4 text-gray-500 text-xs">05 Jul 2026 • 10:00</td>
                        <td class="p-4">
                            <span class="bg-blue-50 text-blue-700 text-xs font-medium px-2.5 py-1 rounded-md">Terdaftar</span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="text-gray-400 text-xs font-medium italic">- Belum Dimulai -</span>
                        </td>
                    </tr>
               
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="p-4 font-semibold text-gray-800">Struktur Data</td>
                        <td class="p-4 text-gray-500 text-xs">Binary Search Tree</td>
                        <td class="p-4 text-gray-600">Budi Santoso</td>
                        <td class="p-4 text-gray-500 text-xs">28 Jun 2026 • 13:00</td>
                        <td class="p-4">
                            <span class="bg-red-50 text-red-700 text-xs font-medium px-2.5 py-1 rounded-md">Tidak Hadir</span>
                        </td>
                        <td class="p-4 text-center">
                            <span class="text-gray-400 text-xs line-through">Feedback Dikunci</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection