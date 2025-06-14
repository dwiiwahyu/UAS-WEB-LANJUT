<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">📂 Kelola Kategori</h1>
        
        <ul class="list-disc pl-5 mb-6 text-gray-700">
            @foreach($kategori as $k)
                <li>{{ $k->nama }}</li>
            @endforeach
        </ul>

        <form action="{{ route('admin.tambahKategori') }}" method="POST" class="flex space-x-2">
            @csrf
            <input type="text" name="nama" placeholder="Nama Kategori" required class="flex-1 border rounded px-3 py-2">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah</button>
        </form>
    </div>
</body>
</html>
