<?php

namespace App\Models;

use App\VerifikasiSurat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKpt extends Model
{
    //
    use HasFactory, VerifikasiSurat;
    protected $table = 'surat_kpts';
    protected $fillable = [
        'no_surat',
        'nama',
        'jabatan',
        'alamat',
        'nama_yang_bersangkutan',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'alamat_yang_bersangkutan',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_orang_tua',
        'penghasilan_per_bulan',
        'keperluan',
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
        return 'Surat Keterangan Penghasilan Tetap';
    }
}
