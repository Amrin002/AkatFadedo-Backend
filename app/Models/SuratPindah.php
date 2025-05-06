<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratPindah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat_pindahs';
    protected $fillable = [
        'no_surat',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_kawin',
        'kewarganegaraan',
        'pekerjaan',
        'alamat',
        'kecamatan',
        'kabupaten',
        'desa_pindah',
        "rt",
        "rw",
        "jalan",
        'kecamatan_pindah',
        'kabupaten_pindah',
        'provinsi',
        'keterangan',
        'status',
        'user_id'
    ];
    protected $casts = [
        'status' => 'string',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
