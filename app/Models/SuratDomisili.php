<?php

namespace App\Models;

use App\VerifikasiSurat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratDomisili extends Model
{
    //
    use HasFactory, VerifikasiSurat;

    protected $table = 'surat_domisilis';
    protected $fillable = [
        'no_surat',
        'type_surat',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_kawin',
        'kewarganegaraan',
        'pekerjaan',
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

    public function getTypeSuratAttribute()
    {
        return 'Surat Keterangan Domisili';
    }
}
