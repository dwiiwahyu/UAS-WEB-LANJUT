<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class WartawanController extends Controller
{
    public function index() {
        // Hanya ambil berita milik wartawan yang sedang login
        $beritas = Berita::where('user_id', Auth::id())->get();
        return view('wartawan.index', compact('beritas'));
    }

    public function create() {
        $kategoris = Kategori::all();
        return view('wartawan.create', compact('kategoris'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image',
            'kategori_id' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $data['user_id'] = Auth::id();
        $data['status'] = 'draft'; // default status draft

        Berita::create($data);

        return redirect()->route('wartawan.index')->with('success', 'Berita berhasil dibuat!');
    }

    public function edit($id) {
        $berita = Berita::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $kategoris = Kategori::all();
        return view('wartawan.edit', compact('berita', 'kategoris'));
    }

    public function update(Request $request, $id) {
        $berita = Berita::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $data = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'nullable|image',
            'kategori_id' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $berita->update($data);

        return redirect()->route('wartawan.index')->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy($id) {
        $berita = Berita::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $berita->delete();

        return redirect()->route('wartawan.index')->with('success', 'Berita berhasil dihapus!');
    }
}
