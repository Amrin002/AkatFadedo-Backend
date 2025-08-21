<?php

namespace App\Models;

use App\VerifikasiSurat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKtm extends Model
{
    //
    use HasFactory, VerifikasiSurat;

    protected $table = 'surat_ktms';
    protected $fillable = [
        'no_surat',
        'type_surat',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_kawin',
        'kewarganegaraan',
        'alamat',
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
    // Define default type for verification
    public function getTypeSuratAttribute()
    {
        return 'Surat Keterangan Tidak Mampu';
    }

    // relasi ke ArsipSurat
    // Relasi ke ArsipSurat (polymorphic)
    public function arsip()
    {
        return $this->morphOne(ArsipSurat::class, 'surat', 'surat_type', 'surat_id');
    }
}
