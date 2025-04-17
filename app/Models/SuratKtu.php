<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SuratKtu extends Model
{
    //use HasFactory, SoftDeletes;

    protected $table = 'surat_ktus';
    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kewarganegaraan',
        'agama',
        'pekerjaan',
        'alamat',
        'no_surat',
        'nama_usaha',
        'jenis_usaha',
        'alamat_usaha',
        'pemilik_usaha',
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
