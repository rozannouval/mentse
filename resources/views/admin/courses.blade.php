<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manajemen Mata Kuliah</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 font-sans flex">

    <div class="w-64 bg-slate-800 min-h-screen text-white flex flex-col justify-between">
        <div>
            <div class="p-5 text-2xl font-bold tracking-wider border-b border-slate-700 text-center">
                MentSe
            </div>

            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    📊 Dashboard
                </a>
                <a href="{{ route('admin.classes.index') }}"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    🏫 Manajemen Kelas
                </a>
                <a href="{{ route('admin.courses.index') }}"
                    class="block py-2.5 px-4 rounded bg-blue-600 font-semibold text-white">
                    📚 Mata Kuliah
                </a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-slate-700">
                    👥 Data User
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-700">
            <div class="text-sm font-medium mb-2 text-slate-400">Login sebagai: Admin</div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full text-center bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded text-sm font-bold transition cursor-pointer">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Manajemen Mata Kuliah</h1>
            <div class="flex items-center space-x-3">
                <span class="text-gray-600 text-sm font-medium">{{ Auth::user()->name ?? 'Administrator' }}</span>
                <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">A
                </div>
            </div>
        </header>

        <main class="p-6 flex-1">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-700">Daftar Mata Kuliah (Courses)</h2>
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm font-semibold shadow transition">
                        + Tambah Mata Kuliah
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                        <thead class="bg-gray-50 text-gray-600 uppercase font-semibold text-xs tracking-wider">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Kode Matkul</th>
                                <th class="px-6 py-3">Nama Mata Kuliah</th>
                                <th class="px-6 py-3">SKS</th>
                                <th class="px-6 py-3">Semester</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700">
                            <tr>
                                <td class="px-6 py-4">1</td>
                                <td class="px-6 py-4 font-mono text-sm text-blue-600 font-semibold">INF-201</td>
                                <td class="px-6 py-4 font-medium text-gray-900">Pemrograman Web 2</td>
                                <td class="px-6 py-4">3 SKS</td>
                                <td class="px-6 py-4">4</td>
                                <td class="px-6 py-4 space-x-2">
                                    <button class="text-blue-600 hover:underline">Edit</button>
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">2</td>
                                <td class="px-6 py-4 font-mono text-sm text-blue-600 font-semibold">INF-104</td>
                                <td class="px-6 py-4 font-medium text-gray-900">Basis Data</td>
                                <td class="px-6 py-4">4 SKS</td>
                                <td class="px-6 py-4">2</td>
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
