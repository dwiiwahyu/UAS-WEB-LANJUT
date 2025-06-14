<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BeritaController extends Controller
{
    public function index() {
        $beritas = Berita::all();
        return view('berita.index', compact('beritas'));
    }

    public function create() {
        $kategoris = Kategori::all();
        return view('berita.create', compact('kategoris'));
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
        $data['status'] = 'draft';

        Berita::create($data);

        return redirect()->route('berita.index');
    }

    // Approval hanya untuk editor
    public function approve($id) {
        $berita = Berita::findOrFail($id);
        $berita->update(['status' => 'published']);

        return redirect()->route('berita.index');
    }
}
