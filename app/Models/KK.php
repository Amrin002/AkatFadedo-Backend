<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class KK extends Model
{
    use HasFactory;

    protected $table = 'kk';

    protected $fillable = [
        'no_kk',
        'dusun',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi'
    ];
    protected $primaryKey = 'no_kk';
    protected $keyType = 'string';


    public function penduduk()
    {
        return $this->hasMany("Penduduk", "no_kk");
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($kk) {
            // Menghapus semua penduduk dengan nomor KK yang dihapus
            Penduduk::where('no_kk', $kk->no_kk)->delete();
        });
    }
}
