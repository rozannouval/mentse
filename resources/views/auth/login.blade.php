<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MENTSE</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.174c0-.21.152-.396.362-.436L12 8.25c.139-.026.282-.026.42 0l7.378 1.488c.21.041.362.227.362.436v3.29c0 .21-.152.396-.362.436L12 15.39c-.139.026-.282.026-.42 0l-7.378-1.488a.437.437 0 0 1-.362-.436v-3.29Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.174v3.29c0 .21.152.396.362.436L12 15.39c.139.026.282.026.42 0l7.378-1.488c.21-.041.362-.227.362-.436v-3.29m-16.42 0a.437.437 0 0 1-.362-.436v-3.29c0-.21.152-.396.362-.436L12 5.25c.139-.026.282-.026.42 0l7.378 1.488c.21.041.362.227.362.436v3.29" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-emerald-700 tracking-wide">MENTSE</h2>
            <p class="text-gray-400 text-xs mt-1 uppercase tracking-wider">Sistem Manajemen Mentor Sebaya</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-lg mb-5 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all duration-200"
                    placeholder="nama@kampus.ac.id">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all duration-200"
                    placeholder="••••••••">
            </div>

            <button type="submit" 
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 px-4 rounded-lg transition duration-200 text-sm shadow-sm shadow-emerald-600/10 cursor-pointer text-center">
                Masuk ke Sistem
            </button>
        </form>

        <div class="text-center mt-8 text-xs text-gray-400">
            &copy; {{ date('Y') }} MENTSE Kelompok 7. All rights reserved.
        </div>
    </div>

</body>
</html>