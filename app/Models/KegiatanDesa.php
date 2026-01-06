<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanDesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',

    ];

    public function fotos()
    {
        return $this->hasMany(GaleriDesa::class, 'kegiatan_desa_id');
    }
}
