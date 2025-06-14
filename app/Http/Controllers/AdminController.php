<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;

class AdminController extends Controller
{
    public function index() {
        $jumlahWartawan = User::role('wartawan')->count();
        $jumlahEditor = User::role('editor')->count();

        return view('admin.index', compact('jumlahWartawan', 'jumlahEditor'));
    }

    public function kelolaUser() {
        $wartawans = User::role('wartawan')->get();
        $editors = User::role('editor')->get();
        return view('admin.kelola-user', compact('wartawans', 'editors'));
    }

    // ================== CRUD Wartawan ===================
    public function storeWartawan(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('wartawan');

        return redirect()->route('admin.kelolaUser')->with('success', 'Wartawan berhasil ditambahkan.');
    }

    public function editWartawan($id) {
        $user = User::findOrFail($id);
        return view('admin.edit-wartawan', compact('user'));
    }

    public function updateWartawan(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admin.kelolaUser')->with('success', 'Wartawan berhasil diupdate.');
    }

    public function deleteWartawan($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.kelolaUser')->with('success', 'Wartawan berhasil dihapus.');
    }

    // ================== CRUD Editor ===================
    public function storeEditor(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('editor');

        return redirect()->route('admin.kelolaUser')->with('success', 'Editor berhasil ditambahkan.');
    }

    public function editEditor($id) {
        $user = User::findOrFail($id);
        return view('admin.edit-editor', compact('user'));
    }

    public function updateEditor(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('admin.kelolaUser')->with('success', 'Editor berhasil diupdate.');
    }

    public function deleteEditor($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.kelolaUser')->with('success', 'Editor berhasil dihapus.');
    }

    // ================== Kategori ===================
    public function kelolaKategori() {
        $kategori = Kategori::all();
        return view('admin.kelola-kategori', compact('kategori'));
    }

    public function tambahKategori(Request $request) {
        $request->validate(['nama' => 'required']);
        Kategori::create(['nama' => $request->nama]);
        return redirect()->route('admin.kelolaKategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function hapusKategori($id) {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('admin.kelolaKategori')->with('success', 'Kategori berhasil dihapus');
    }
}
