<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\WartawanController;
use App\Http\Controllers\BeritaController;
use Illuminate\Support\Facades\Auth;

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});


// Profile (semua user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route bawaan Breeze bisa dihapus kalau tidak dipakai:
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// --- AUTH ROUTE BREEZE ---
require __DIR__.'/auth.php';

// ========================
// ADMIN ROUTES
// ========================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Kelola User
    Route::get('/admin/kelola-user', [AdminController::class, 'kelolaUser'])->name('admin.kelolaUser');

    // Wartawan CRUD
    Route::post('/admin/kelola-user/wartawan', [AdminController::class, 'storeWartawan'])->name('wartawan.store');
    Route::get('/admin/kelola-user/wartawan/{id}/edit', [AdminController::class, 'editWartawan'])->name('wartawan.edit');
    Route::put('/admin/kelola-user/wartawan/{id}', [AdminController::class, 'updateWartawan'])->name('wartawan.update');
    Route::delete('/admin/kelola-user/wartawan/{id}', [AdminController::class, 'deleteWartawan'])->name('wartawan.destroy');

    // Editor CRUD
    Route::post('/admin/kelola-user/editor', [AdminController::class, 'storeEditor'])->name('editor.store');
    Route::get('/admin/kelola-user/editor/{id}/edit', [AdminController::class, 'editEditor'])->name('editor.edit');
    Route::put('/admin/kelola-user/editor/{id}', [AdminController::class, 'updateEditor'])->name('editor.update');
    Route::delete('/admin/kelola-user/editor/{id}', [AdminController::class, 'deleteEditor'])->name('editor.destroy');

    // Kelola Kategori
    Route::get('/admin/kelola-kategori', [AdminController::class, 'kelolaKategori'])->name('admin.kelolaKategori');
    Route::post('/admin/tambah-kategori', [AdminController::class, 'tambahKategori'])->name('admin.tambahKategori');
    Route::delete('/admin/hapus-kategori/{id}', [AdminController::class, 'hapusKategori'])->name('admin.hapusKategori');
});

// ========================
// EDITOR ROUTES
// ========================
Route::middleware(['auth', 'role:editor'])->group(function () {
    Route::get('/editor/dashboard', [EditorController::class, 'index'])->name('editor.dashboard');
    Route::post('/editor/berita/{id}/approve', [EditorController::class, 'approve'])->name('editor.berita.approve');
    Route::post('/editor/berita/{id}/reject', [EditorController::class, 'reject'])->name('editor.berita.reject');
});

// ========================
// WARTAWAN ROUTES
// ========================
Route::middleware(['auth', 'role:wartawan'])->group(function () {
    Route::get('/wartawan/dashboard', [WartawanController::class, 'index'])->name('wartawan.index');
    Route::get('/wartawan/create', [WartawanController::class, 'create'])->name('wartawan.create');
    Route::post('/wartawan', [WartawanController::class, 'store'])->name('wartawan.store');
    Route::get('/wartawan/{id}/edit', [WartawanController::class, 'edit'])->name('wartawan.edit');
    Route::put('/wartawan/{id}', [WartawanController::class, 'update'])->name('wartawan.update');
    Route::delete('/wartawan/{id}', [WartawanController::class, 'destroy'])->name('wartawan.destroy');
});

// ========================
// BERITA ROUTES (Wartawan & Editor)
// ========================
Route::middleware(['auth', 'role:wartawan|editor'])->group(function () {
    Route::resource('berita', BeritaController::class);
});

// ========================
// LOGOUT
// ========================
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
