@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Total User</p>
        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalUser }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Dosen</p>
        <p class="text-3xl font-bold text-purple-600 mt-1">{{ $totalDosen }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Mentor</p>
        <p class="text-3xl font-bold text-amber-600 mt-1">{{ $totalMentor }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Mahasiswa</p>
        <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $totalMahasiswa }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Mata Kuliah</p>
        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalMataKuliah }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Kelas</p>
        <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $totalKelas }}</p>
    </div>
    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-200">
        <p class="text-sm font-medium text-gray-500 uppercase">Sesi Mentoring</p>
        <p class="text-3xl font-bold text-teal-600 mt-1">{{ $totalSesi }}</p>
    </div>
</div>
@endsection
