@extends('layouts.mahasiswa')
@section('title', 'Riwayat Sesi')
@section('active', 'mahasiswa.riwayat')

@section('content')
@if ($riwayatSesi->isEmpty())
<div class="text-center py-16">
    <p class="text-gray-900 font-medium">Belum ada riwayat</p>
    <p class="text-sm text-gray-500 mt-1">Sesi yang Anda ikuti akan muncul di sini.</p>
</div>
@else
<div class="space-y-3">
    @foreach ($riwayatSesi as $ps)
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <div class="flex items-start justify-between">
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-1">
                    <h3 class="text-[15px] font-semibold text-gray-900 truncate">{{ $ps->sesi->topik ?? '-' }}</h3>
                    <x-badge type="{{ $ps->status }}">{{ ucfirst(str_replace('_', ' ', $ps->status)) }}</x-badge>
                </div>
                <p class="text-sm text-gray-500">
                    {{ $ps->sesi->kelas->mataKuliah->nama_mata_kuliah ?? '-' }}
                    &middot; Mentor: {{ $ps->sesi->kelas->mentor->name ?? '-' }}
                </p>
                <p class="text-xs text-gray-400 mt-0.5">
                    {{ $ps->sesi ? \Carbon\Carbon::parse($ps->sesi->tanggal)->format('d M Y') : '-' }}
                    {{ $ps->sesi->jam_mulai ? ', ' . $ps->sesi->jam_mulai : '' }}
                </p>
            </div>
            <div class="flex items-center gap-2 ml-4 flex-shrink-0">
                @if ($ps->status == 'hadir' && !$ps->feedback)
                <a href="{{ route('mahasiswa.feedback.create', $ps) }}" class="px-3 py-1.5 bg-gray-900 hover:bg-gray-800 text-white text-xs font-medium rounded-lg transition-colors">
                    Isi Feedback
                </a>
                @elseif ($ps->status == 'hadir' && $ps->feedback)
                <span class="text-xs text-gray-400">Sudah dinilai</span>
                @elseif ($ps->status == 'terdaftar')
                <form action="{{ route('mahasiswa.sesi.batalkan', $ps) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="button" onclick="confirmAction(this.closest('form'), 'Batalkan', 'Yakin batalkan pendaftaran <strong>{{ $ps->sesi->topik ?? 'ini' }}</strong>?', 'Ya, Batalkan')" class="px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded-lg transition-colors cursor-pointer">
                        Batal
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection