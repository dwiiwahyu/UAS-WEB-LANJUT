<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;


class Berita extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'konten', 'gambar', 'kategori_id', 'user_id', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }
}
