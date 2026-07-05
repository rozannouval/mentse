@extends('layouts.admin')
@section('title', 'Log Aktivitas')

@section('content')
<div class="bg-white rounded-xl border border-slate-100 shadow-sm">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="text-base font-semibold text-slate-900">Log Aktivitas Sistem</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/50">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Waktu</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">User</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Aktivitas</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">IP Address</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-slate-500 uppercase">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($logs as $log)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-5 py-3.5 text-xs text-slate-500 whitespace-nowrap">{{ $log->created_at->format('d M Y H:i') }}</td>
                    <td class="px-5 py-3.5">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500 overflow-hidden flex-shrink-0">
                                @if ($log->user && $log->user->photo)
                                <img src="{{ asset('storage/' . $log->user->photo) }}" alt="" class="w-full h-full object-cover">
                                @else
                                {{ $log->user ? strtoupper(substr($log->user->name, 0, 1)) : '?' }}
                                @endif
                            </div>
                            <span class="text-sm text-slate-700">{{ $log->user->name ?? 'System' }}</span>
                        </div>
                    </td>
                    <td class="px-5 py-3.5">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-600/20">
                            {{ $log->activity }}
                        </span>
                    </td>
                    <td class="px-5 py-3.5 text-xs font-mono text-slate-500">{{ $log->ip_address ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-xs text-slate-500">{{ $log->description }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 text-center text-slate-400">Belum ada aktivitas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if ($logs->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
