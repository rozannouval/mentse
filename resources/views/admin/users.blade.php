<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Pengguna</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans flex">

    <div class="w-64 bg-slate-800 min-h-screen text-white flex flex-col justify-between">
        <div>
            <div class="p-5 text-2xl font-bold tracking-wider border-b border-slate-700 text-center">
                MentSe
            </div>
            
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.classes.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    🏫 Manajemen Kelas
                </a>
                <a href="{{ route('admin.courses.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    📚 Mata Kuliah
                </a>
                <a href="{{ route('admin.reports.index') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    📈 Laporan Aktivitas
                </a>
                <a href="{{ route('admin.users.index') }}" class="block py-2.5 px-4 rounded bg-blue-600 font-semibold text-white">
                    👥 Data User
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-700">
            <div class="text-sm font-medium mb-2 text-slate-400">Login sebagai: Admin</div>
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
            <h1 class="text-xl font-bold text-gray-800">Manajemen Data Pengguna</h1>
            <div class="flex items-center space-x-3">
                <span class="text-gray-600 text-sm font-medium">{{ Auth::user()->name ?? 'Administrator' }}</span>
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">A</div>
            </div>
        </header>

        <main class="p-6 flex-1">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-700">Daftar Pengguna Sistem</h2>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold shadow transition">
                        + Tambah User Baru
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Role / Peran</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700">
                            <tr>
                                <td class="px-6 py-4">1</td>
                                <td class="px-6 py-4 font-medium text-gray-900">Muhammad Eka Apriansyah</td>
                                <td class="px-6 py-4">admin@mentse.ac.id</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">Admin</span>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <button class="text-blue-600 hover:underline">Edit</button>
                                    <button class="text-slate-400 cursor-not-allowed" disabled>Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">2</td>
                                <td class="px-6 py-4 font-medium text-gray-900">Dr. Irwan Hermawan</td>
                                <td class="px-6 py-4">irwan@dosen.mentse.ac.id</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold bg-purple-100 text-purple-800 rounded-full">Dosen</span>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <button class="text-blue-600 hover:underline">Edit</button>
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">3</td>
                                <td class="px-6 py-4 font-medium text-gray-900">Alex Setiawan</td>
                                <td class="px-6 py-4">alex@mentor.mentse.com</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold bg-amber-100 text-amber-800 rounded-full">Mentor</span>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <button class="text-blue-600 hover:underline">Edit</button>
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">4</td>
                                <td class="px-6 py-4 font-medium text-gray-900">Budi Santoso</td>
                                <td class="px-6 py-4">budi@mahasiswa.mentse.ac.id</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Mahasiswa</span>
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <button class="text-blue-600 hover:underline">Edit</button>
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>