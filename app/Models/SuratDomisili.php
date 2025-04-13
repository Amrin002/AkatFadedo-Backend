<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratDomisili extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'surat_domisilis';
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
        'surat_keluar',
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

