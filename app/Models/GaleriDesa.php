<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriDesa extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'nama_kegiatan',
        'image',
        'kegiatan_desa_id',
        'tanggal',
        'keterangan'
    ];
    public function kegiatan()
    {
        return $this->belongsTo(KegiatanDesa::class, 'kegiatan_desa_id');
    }
}
