<!DOCTYPE html>
<html>
<head>
    <title>Wartawan Dashboard</title>
    <style>
        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="logout-button">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <h1>Dashboard Wartawan</h1>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('wartawan.create') }}">+ Tambah Berita Baru</a>

    <h2>Daftar Berita Anda</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beritas as $index => $berita)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $berita->judul }}</td>
                    <td>{{ ucfirst($berita->status) }}</td>
                    <td>
                        <a href="{{ route('wartawan.edit', $berita->id) }}">Edit</a>
                        <form action="{{ route('wartawan.destroy', $berita->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada berita.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
