<!DOCTYPE html>
<html>
<head>
    <title>Tambah Berita</title>
</head>
<body>
    <h1>Tambah Berita</h1>

    <form action="{{ route('wartawan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Judul:</label><br>
        <input type="text" name="judul" required><br><br>

        <label>Konten:</label><br>
        <textarea name="konten" rows="5" required></textarea><br><br>

        <label>Kategori:</label><br>
        <select name="kategori_id" required>
            @foreach($kategoris as $kategori)
        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
         @endforeach
        </select><br><br>

{{-- Tambah kategori langsung --}}
<form action="{{ route('kategori.store.inline') }}" method="POST">
    @csrf
    <input type="text" name="nama_kategori" placeholder="Tambah kategori baru" required>
    <button type="submit">Tambah Kategori</button>
</form>
<br>


        <label>Gambar:</label><br>
        <input type="file" name="gambar"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('wartawan.index') }}">← Kembali</a>
</body>
</html>
