<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'konten',
        'gambar',
        'user_id',
        'kategori',
    ];

    public $timestamps = true;

    // Akses URL gambar
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? Storage::url($this->gambar) : asset('default-image.jpg');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Format tanggal
    public function getTanggalAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d-m-Y');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            $berita->slug = Str::slug($berita->judul) . '-' . Str::random(5);
        });
    }

    
}
