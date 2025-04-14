<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Penduduk extends Model
{
    //
    use HasFactory;

    protected $table = 'penduduks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'no_kk',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status',
        'status_keluarga',
        'golongan_darah',
        'kewarganegaraan',
        'nama_ayah',
        'nama_ibu',
        'email',
        'no_hp',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id');
    }

    /**
     * Relasi ke tabel KK (1:M)
     */
    public function kk()
    {
        return $this->belongsTo(KK::class, 'no_kk', 'no_kk');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($id) {
            // Menghapus semua penduduk dengan nomor KK yang dihapus
            Penduduk::where('id', $id->id)->delete();
        });
    }
}
