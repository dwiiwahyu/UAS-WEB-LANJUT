<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kelola Wartawan & Editor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-6xl mx-auto space-y-8">
        <h2 class="text-3xl font-bold text-gray-800">👥 Kelola Wartawan & Editor</h2>

        <div>
            <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Kembali ke Dashboard</a>
        </div>

        {{-- Kelola Wartawan --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-semibold mb-4">📢 Tambah Wartawan</h3>
            <form method="POST" action="{{ route('wartawan.store') }}" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Nama" required class="w-full border rounded px-3 py-2">
                <input type="email" name="email" placeholder="Email" required class="w-full border rounded px-3 py-2">
                <input type="password" name="password" placeholder="Password" required class="w-full border rounded px-3 py-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Wartawan</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <h3 class="text-lg font-semibold mt-6 mb-2">📋 Daftar Wartawan</h3>
            <table class="min-w-full bg-white border rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border">No</th>
                        <th class="py-2 px-4 border">Nama</th>
                        <th class="py-2 px-4 border">Email</th>
                        <th class="py-2 px-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wartawans as $index => $user)
                        <tr>
                            <td class="py-2 px-4 border">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border">{{ $user->name }}</td>
                            <td class="py-2 px-4 border">{{ $user->email }}</td>
                            <td class="py-2 px-4 border space-x-2">
                                <a href="{{ route('wartawan.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('wartawan.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus user ini?')" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Kelola Editor --}}
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-semibold mb-4">🖊️ Tambah Editor</h3>
            <form method="POST" action="{{ route('editor.store') }}" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Nama" required class="w-full border rounded px-3 py-2">
                <input type="email" name="email" placeholder="Email" required class="w-full border rounded px-3 py-2">
                <input type="password" name="password" placeholder="Password" required class="w-full border rounded px-3 py-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah Editor</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <h3 class="text-lg font-semibold mt-6 mb-2">📋 Daftar Editor</h3>
            <table class="min-w-full bg-white border rounded shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border">No</th>
                        <th class="py-2 px-4 border">Nama</th>
                        <th class="py-2 px-4 border">Email</th>
                        <th class="py-2 px-4 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($editors as $index => $user)
                        <tr>
                            <td class="py-2 px-4 border">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border">{{ $user->name }}</td>
                            <td class="py-2 px-4 border">{{ $user->email }}</td>
                            <td class="py-2 px-4 border space-x-2">
                                <a href="{{ route('editor.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('editor.destroy', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin hapus user ini?')" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
