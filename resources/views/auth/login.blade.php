<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MENTSE</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white shadow-lg shadow-blue-500/10 mb-5">
                <svg class="w-9 h-9 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">MENTSE <br> Sistem Manajemen Mentor Sebaya</h1>
            <p class="text-slate-500 text-sm mt-1">Masuk ke sistem mentoring</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 p-6">
            @if ($errors->any())
                <div class="mb-5 p-3.5 bg-rose-50 border border-rose-200 rounded-xl text-sm text-rose-600">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all"
                        placeholder="nama@kampus.ac.id">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-600 mb-1.5">Password</label>
                    <input type="password" id="password" name="password" required
                        class="block w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-900 placeholder-slate-400 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all"
                        placeholder="Masukkan password">
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-800 text-white font-medium py-3 px-4 rounded-xl transition-all cursor-pointer text-sm shadow-lg shadow-slate-900/10 hover:shadow-slate-900/20">
                    Masuk
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-slate-400 text-xs">&copy; {{ date('Y') }} MENTSE</p>
    </div>
</body>
</html>
