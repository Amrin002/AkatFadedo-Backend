<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_surat',
        'nama_pemohon',
        'tanggal_terbit',
        'status',
        'surat_type',
        'surat_id',
        'keterangan',
    ];
    protected $casts = [
        'status' => 'string',
        'tanggal_terbit' => 'date',
    ];

    // Append jenis_surat dan nomor_urut sebagai computed attributes
    protected $appends = ['jenis_surat', 'nomor_urut'];

    /**
     * Relasi polymorphic ke surat asli
     */
    public function surat()
    {
        return $this->morphTo('surat', 'surat_type', 'surat_id');
    }

    /**
     * Accessor untuk mendapatkan jenis surat yang readable
     */
    public function getJenisSuratAttribute()
    {
        return $this->getJenisSuratFromType($this->surat_type);
    }

    /**
     * Accessor untuk mendapatkan nomor urut dari nomor surat
     * Contoh: "01 / SKTM / NA-AF / VIII / 2025" -> 1
     */
    public function getNomorUrutAttribute()
    {
        return $this->extractNomorUrut($this->nomor_surat);
    }

    /**
     * Scope untuk filter berdasarkan jenis surat
     */
    public function scopeJenisSurat($query, $jenis)
    {
        $suratType = $this->getSuratTypeFromJenis($jenis);
        return $query->where('surat_type', $suratType);
    }

    /**
     * Scope untuk filter berdasarkan tahun
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->whereYear('tanggal_terbit', $tahun);
    }

    /**
     * Scope untuk filter berdasarkan bulan dan tahun
     */
    public function scopeBulanTahun($query, $bulan, $tahun)
    {
        return $query->whereMonth('tanggal_terbit', $bulan)
            ->whereYear('tanggal_terbit', $tahun);
    }

    /**
     * Static method untuk membuat arsip baru
     */
    public static function buatArsip($surat)
    {
        return self::create([
            'nomor_surat' => $surat->no_surat,
            'nama_pemohon' => $surat->nama,
            'tanggal_terbit' => $surat->tanggal_terbit ?? now(),
            'surat_type' => get_class($surat),
            'surat_id' => $surat->id,
            'keterangan' => $surat->keterangan ?? null
        ]);
    }

    /**
     * Get jenis surat readable dari surat_type
     */
    public static function getJenisSuratFromType($suratType)
    {
        $mapping = [
            'App\Models\SuratKtm' => 'Surat Keterangan Tidak Mampu',
            'App\Models\SuratKtu' => 'Surat Keterangan Tempat Usaha',
            'App\Models\SuratDomisili' => 'Surat Keterangan Domisili',
            'App\Models\SuratPindah' => 'Surat Keterangan Pindah Domisili',
        ];

        return $mapping[$suratType] ?? 'Surat Lainnya';
    }

    /**
     * Get surat_type dari jenis surat readable (untuk filtering)
     */
    public static function getSuratTypeFromJenis($jenisSurat)
    {
        $mapping = [
            'Surat Keterangan Tidak Mampu' => 'App\Models\SuratKtm',
            'Surat Keterangan Tempat Usaha' => 'App\Models\SuratKtu',
            'Surat Keterangan Domisili' => 'App\Models\SuratDomisili',
            'Surat Keterangan Pindah Domisili' => 'App\Models\SuratPindah',
        ];

        return $mapping[$jenisSurat] ?? null;
    }

    /**
     * Extract nomor urut dari nomor surat
     * Format: "01 / SKTM / NA-AF / VIII / 2025" -> 1
     */
    private function extractNomorUrut($nomorSurat)
    {
        if (!$nomorSurat) {
            return null;
        }

        $parts = explode(' / ', $nomorSurat);
        return isset($parts[0]) ? intval($parts[0]) : null;
    }

    /**
     * Get kode jenis surat dari nomor surat
     * Format: "01 / SKTM / NA-AF / VIII / 2025" -> "SKTM"
     */
    public function getKodeJenisSurat()
    {
        if (!$this->nomor_surat) {
            return null;
        }

        $parts = explode(' / ', $this->nomor_surat);
        return isset($parts[1]) ? $parts[1] : null;
    }

    /**
     * Get tahun dari nomor surat
     * Format: "01 / SKTM / NA-AF / VIII / 2025" -> 2025
     */
    public function getTahunFromNomor()
    {
        if (!$this->nomor_surat) {
            return null;
        }

        $parts = explode(' / ', $this->nomor_surat);
        return isset($parts[4]) ? intval($parts[4]) : null;
    }

    /**
     * Get statistik arsip
     */
    public static function getStatistik()
    {
        // Ambil data dengan group by surat_type
        $byType = self::selectRaw('surat_type, COUNT(*) as total')
            ->groupBy('surat_type')
            ->pluck('total', 'surat_type')
            ->toArray();

        // Convert ke jenis surat yang readable
        $byJenis = [];
        foreach ($byType as $type => $total) {
            $jenis = self::getJenisSuratFromType($type);
            $byJenis[$jenis] = $total;
        }

        return [
            'total_arsip' => self::count(),
            'arsip_tahun_ini' => self::whereYear('tanggal_terbit', now()->year)->count(),
            'arsip_bulan_ini' => self::whereMonth('tanggal_terbit', now()->month)
                ->whereYear('tanggal_terbit', now()->year)->count(),
            'by_jenis' => $byJenis
        ];
    }

    /**
     * Get semua jenis surat yang tersedia (readable)
     */
    public static function getAvailableJenisSurat()
    {
        $suratTypes = self::distinct()->pluck('surat_type');

        return $suratTypes->map(function ($type) {
            return self::getJenisSuratFromType($type);
        })->filter()->values()->toArray();
    }

    /**
     * Cari arsip berdasarkan nomor urut dan jenis surat
     */
    public static function cariByNomorUrut($nomorUrut, $jenisSurat = null)
    {
        $query = self::query();

        if ($jenisSurat) {
            $query->jenisSurat($jenisSurat);
        }

        return $query->get()->filter(function ($arsip) use ($nomorUrut) {
            return $arsip->nomor_urut == $nomorUrut;
        });
    }
}
