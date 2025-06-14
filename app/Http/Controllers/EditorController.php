<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class EditorController extends Controller
{
    public function index() {
        $beritas = Berita::whereIn('status', ['draft', 'pending'])->get();
        return view('editor.index', compact('beritas'));
    }

    public function approve($id) {
        $berita = Berita::findOrFail($id);
        $berita->status = 'published';
        $berita->save();

        return redirect()->route('editor.dashboard')->with('success', 'Berita berhasil dipublish.');
    }

    public function reject($id) {
        $berita = Berita::findOrFail($id);
        $berita->status = 'rejected';
        $berita->save();

        return redirect()->route('editor.dashboard')->with('success', 'Berita berhasil ditolak.');
    }
}
