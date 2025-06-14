<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
</head>
<body>
    <h1>Edit Berita</h1>

    <form action="{{ route('wartawan.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Judul:</label><br>
        <input type="text" name="judul" value="{{ $berita->judul }}" required><br><br>

        <label>Konten:</label><br>
        <textarea name="konten" rows="5" required>{{ $berita->konten }}</textarea><br><br>

        <label>Kategori:</label><br>
        <select name="kategori_id" required>
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ $kategori->id == $berita->kategori_id ? 'selected' : '' }}>
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select><br><br>

        <label>Gambar (Kosongkan jika tidak ingin mengganti):</label><br>
        <input type="file" name="gambar"><br><br>

        <button type="submit">Update</button>
    </form>

    <a href="{{ route('wartawan.index') }}">← Kembali</a>
</body>
</html>
