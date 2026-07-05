@props(['title', 'role'])

@php
$user = Auth::user();
$initial = strtoupper(substr($user->name, 0, 1));
$badge = match($role) {
    'admin' => 'bg-red-500',
    'dosen' => 'bg-violet-500',
    'mentor' => 'bg-amber-500',
    'mahasiswa' => 'bg-emerald-500',
    default => 'bg-gray-500',
};
@endphp

<header class="sticky top-0 z-20 bg-white/70 backdrop-blur-md border-b border-gray-100">
    <div class="flex items-center justify-between px-6 h-16">
        <h1 class="text-[17px] font-semibold text-gray-900 tracking-tight">{{ $title }}</h1>

        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-2.5 px-2 py-1 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                <div class="w-7 h-7 rounded-full {{ $badge }} flex items-center justify-center text-xs font-semibold text-white">
                    @if ($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="" class="w-full h-full object-cover rounded-full">
                    @else
                    {{ $initial }}
                    @endif
                </div>
                <span class="hidden sm:block text-sm text-gray-700">{{ $user->name }}</span>
                <svg class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" @click.outside="open = false"
                class="absolute right-0 mt-2 w-48 bg-white rounded-lg border border-gray-100 shadow-sm"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
                <div class="px-4 py-2.5 border-b border-gray-50">
                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                    <p class="text-xs text-gray-500 capitalize">{{ $role }}</p>
                </div>
                <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">Profil</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors cursor-pointer">Keluar</button>
                </form>
            </div>
        </div>
    </div>
</header>