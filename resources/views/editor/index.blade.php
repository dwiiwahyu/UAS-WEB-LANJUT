<!DOCTYPE html>
<html>
<head>
    <title>Editor Dashboard</title>
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

    <h1>Dashboard Editor</h1>
    <h2>Daftar Berita (Draft / Pending)</h2>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Konten Singkat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beritas as $index => $berita)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $berita->judul }}</td>
                    <td>{{ Str::limit(strip_tags($berita->konten), 50) }}</td>
                    <td>{{ ucfirst($berita->status) }}</td>
                    <td>
                        <form action="{{ route('editor.berita.approve', $berita->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('Publish berita ini?')">Approve</button>
                        </form>
                        <form action="{{ route('editor.berita.reject', $berita->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('Tolak berita ini?')">Reject</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada berita draft/pending.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
