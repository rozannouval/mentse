<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Mahasiswa MENTSE</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz@14..32&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif;}</style>
</head>
<body class="bg-[#f6f5f2]">
    <x-sidebar role="mahasiswa" />

    <div class="ml-56 min-h-screen">
        <x-header :title="View::yieldContent('title', 'Dashboard')" role="mahasiswa" />

        <main class="p-6">
            <x-alert />
            @yield('content')
        </main>
    </div>

    <x-confirm-modal />
</body>
</html>
