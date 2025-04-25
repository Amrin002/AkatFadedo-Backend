<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'konten', 'gambar', 'user_id'];
    public $timestamps = true;
    // Fungsi untuk mendapatkan URL gambar
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? Storage::url($this->gambar) : asset('default-image.jpg');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTanggalAttribute()
    {
    return \Carbon\Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
