<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans flex">

    <div class="w-64 bg-slate-800 min-h-screen text-white flex flex-col justify-between">
        <div>
            <div class="p-5 text-2xl font-bold tracking-wider border-b border-slate-700 text-center">
                MentSe
            </div>
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('dosen.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('dosen.dashboard') ? 'bg-blue-600 font-semibold' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('dosen.kelas.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700 {{ request()->routeIs('dosen.kelas.*') ? 'bg-blue-600 font-semibold' : '' }}">
                    Kelas Saya
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-slate-700">
            <div class="text-sm font-medium mb-2 text-slate-400">Login sebagai: Dosen</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-center bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded text-sm font-bold transition cursor-pointer">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">@yield('title', 'Dashboard')</h1>
            <div class="flex items-center space-x-3">
                <span class="text-gray-600 text-sm font-medium">{{ Auth::user()->name }}</span>
                <div class="w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center font-bold text-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>
        <main class="p-6 flex-1">
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded-lg mb-5 text-sm">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-lg mb-5 text-sm">{{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>

</body>
</html>
