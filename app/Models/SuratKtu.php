<?php

namespace App\Models;

use App\VerifikasiSurat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SuratKtu extends Model
{
    use HasFactory, VerifikasiSurat;

    protected $table = 'surat_ktus';
    protected $fillable = [
        'no_surat',
        'type_surat',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kewarganegaraan',
        'agama',
        'pekerjaan',
        'alamat',
        'nama_usaha',
        'jenis_usaha',
        'alamat_usaha',
        'pemilik_usaha',
        'qr_code',
        'verifikasi_token',
        'tanggal_terbit',
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

    public function getTypeSuratAttribute()
    {
        return 'Surat Keterangan Tempat Usaha';
    }
}
