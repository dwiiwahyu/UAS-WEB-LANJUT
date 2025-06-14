<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">👋 Halo, Admin!</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
        </form>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-white p-4 shadow rounded">
            <p class="text-gray-700">🧑 Jumlah Wartawan:</p>
            <p class="text-xl font-bold">{{ $jumlahWartawan }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <p class="text-gray-700">📝 Jumlah Editor:</p>
            <p class="text-xl font-bold">{{ $jumlahEditor }}</p>
        </div>
    </div>

    <div class="space-y-2">
        <a href="{{ route('admin.kelolaUser') }}" class="text-blue-600 hover:underline">Kelola Wartawan & Editor</a><br>
        <a href="{{ route('admin.kelolaKategori') }}" class="text-blue-600 hover:underline">Kelola Kategori</a>
    </div>
</body>
</html>
