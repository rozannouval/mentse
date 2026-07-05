<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - MENTSE</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen py-10">

    <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 w-full max-w-md">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-emerald-700 tracking-wide">MENTSE</h2>
            <p class="text-gray-400 text-xs mt-1 uppercase tracking-wider">Pendaftaran Akun Baru</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-lg mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all duration-200"
                    placeholder="Masukkan nama lengkap Anda">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all duration-200"
                    placeholder="nama@kampus.ac.id">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Daftar Sebagai</label>
                <select id="role" name="role" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all duration-200">
                    <option value="" disabled selected>Pilih peran Anda</option>
                    <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa (Peserta Mentoring)</option>
                    <option value="mentor" {{ old('role') == 'mentor' ? 'selected' : '' }}>Mentor (Pendamping Belajar)</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all duration-200"
                    placeholder="Minimal 8 karakter">
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-600 text-xs font-semibold uppercase tracking-wider mb-2">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all duration-200"
                    placeholder="Ulangi password Anda">
            </div>

            <button type="submit" 
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2.5 px-4 rounded-lg transition duration-200 text-sm shadow-sm shadow-emerald-600/10 cursor-pointer text-center mb-4">
                Daftar Akun
            </button>

            <div class="text-center text-sm text-gray-500">
                Sudah punya akun? <a href="{{ url('/login') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold transition duration-150">Masuk di sini</a>
            </div>
        </form>
    </div>

</body>
</html>