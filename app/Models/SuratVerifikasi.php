<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuratVerifikasi extends Model
{
    protected $table = 'surat_verifikasis';

    protected $fillable = [
        'type_surat',
        'nama_pemohon',
        'nomor_surat',
        'tanggal_terbit',
        'status',
        'nama_pejabat',
        'nip',
        'jabatan'
    ];

    protected $dates = [
        'tanggal_terbit'
    ];
    // Ensure this is unique
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Check if this nomor_surat already exists
            if ($model->nomor_surat) {
                $exists = self::where('nomor_surat', $model->nomor_surat)
                    ->where('id', '!=', $model->id) // Skip current model in check
                    ->exists();

                if ($exists) {
                    // Return false to prevent saving
                    return false;
                }
            }
        });
    }
    public function setStatusAttribute($value)
    {
        $allowedStatuses = ['TERVERIFIKASI', 'TIDAK VALID'];

        $this->attributes['status'] = in_array(strtoupper($value), $allowedStatuses)
            ? strtoupper($value)
            : 'TERVERIFIKASI';
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'TERVERIFIKASI');
    }

    public function scopeTypeSurat($query, $type)
    {
        return $query->where('type_surat', strtoupper($type));
    }

    public static function findByNomorSurat($nomorSurat)
    {
        return self::where('nomor_surat', $nomorSurat)->first();
    }
}
