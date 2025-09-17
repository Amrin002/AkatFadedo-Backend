<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Apbdes extends Model
{
    use HasFactory;
    protected $table = 'apbdes';
    protected $fillable = [
        'pendapatan',
        'penyelenggaraan',
        'pelaksanaan',
        'pembinaan',
        'pemberdayaan',
        'penanggulangan',
        'pejabat',
        'tahun',
        'file',
    ];

    // Method untuk mendapatkan total pengeluaran
    public function getTotalPengeluaranAttribute()
    {
        return $this->penyelenggaraan + $this->pelaksanaan + $this->pembinaan + $this->pemberdayaan + $this->penanggulangan;
    }

    // Method untuk mendapatkan persentase alokasi per bidang
    public function getPersentaseAlokasi()
    {
        $totalPengeluaran = $this->total_pengeluaran;
        
        if ($totalPengeluaran == 0) {
            return [
                'penyelenggaraan' => 0,
                'pelaksanaan' => 0,
                'pembinaan' => 0,
                'pemberdayaan' => 0,
                'penanggulangan' => 0
            ];
        }

        return [
            'penyelenggaraan' => round(($this->penyelenggaraan / $totalPengeluaran) * 100, 1),
            'pelaksanaan' => round(($this->pelaksanaan / $totalPengeluaran) * 100, 1),
            'pembinaan' => round(($this->pembinaan / $totalPengeluaran) * 100, 1),
            'pemberdayaan' => round(($this->pemberdayaan / $totalPengeluaran) * 100, 1),
            'penanggulangan' => round(($this->penanggulangan / $totalPengeluaran) * 100, 1)
        ];
    }

    // Method untuk mendapatkan sisa anggaran
    public function getSisaAnggaranAttribute()
    {
        return $this->pendapatan - $this->total_pengeluaran;
    }

    // Method untuk mendapatkan persentase realisasi
    public function getPersentaseRealisasiAttribute()
    {
        if ($this->pendapatan == 0) {
            return 0;
        }
        return round(($this->total_pengeluaran / $this->pendapatan) * 100, 2);
    }

    // Method untuk format mata uang
    public function formatRupiah($nilai)
    {
        return 'Rp ' . number_format($nilai, 0, ',', '.');
    }

    // Method untuk mendapatkan bidang dengan alokasi terbesar
    public function getBidangTerbesarAttribute()
    {
        $bidang = [
            'penyelenggaraan' => $this->penyelenggaraan,
            'pelaksanaan' => $this->pelaksanaan,
            'pembinaan' => $this->pembinaan,
            'pemberdayaan' => $this->pemberdayaan,
            'penanggulangan' => $this->penanggulangan
        ];

        $bidangTerbesar = array_keys($bidang, max($bidang))[0];
        
        $namaBidang = [
            'penyelenggaraan' => 'Penyelenggaraan Pemerintahan',
            'pelaksanaan' => 'Pelaksanaan Pembangunan',
            'pembinaan' => 'Pembinaan Kemasyarakatan',
            'pemberdayaan' => 'Pemberdayaan Masyarakat',
            'penanggulangan' => 'Penanggulangan Bencana'
        ];

        return [
            'bidang' => $namaBidang[$bidangTerbesar],
            'nilai' => $bidang[$bidangTerbesar],
            'persentase' => $this->getPersentaseAlokasi()[$bidangTerbesar]
        ];
    }

    // Method untuk mendapatkan tren anggaran (jika ada data tahun sebelumnya)
    public static function getTrenAnggaran($tahunSekarang, $tahunSebelumnya = null)
    {
        $anggaranSekarang = self::where('tahun', $tahunSekarang)->first();
        
        if (!$tahunSebelumnya) {
            $tahunSebelumnya = $tahunSekarang - 1;
        }
        
        $anggaranSebelumnya = self::where('tahun', $tahunSebelumnya)->first();
        
        if (!$anggaranSekarang || !$anggaranSebelumnya) {
            return null;
        }

        $persentaseKenaikan = round((($anggaranSekarang->pendapatan - $anggaranSebelumnya->pendapatan) / $anggaranSebelumnya->pendapatan) * 100, 2);
        
        return [
            'tahun_sekarang' => $tahunSekarang,
            'anggaran_sekarang' => $anggaranSekarang->pendapatan,
            'tahun_sebelumnya' => $tahunSebelumnya,
            'anggaran_sebelumnya' => $anggaranSebelumnya->pendapatan,
            'selisih' => $anggaranSekarang->pendapatan - $anggaranSebelumnya->pendapatan,
            'persentase_perubahan' => $persentaseKenaikan,
            'status' => $persentaseKenaikan > 0 ? 'naik' : ($persentaseKenaikan < 0 ? 'turun' : 'tetap')
        ];
    }

    // Method untuk validasi anggaran
    public function isAnggaranSeimbang()
    {
        return $this->pendapatan >= $this->total_pengeluaran;
    }

    // Method untuk mendapatkan rekomendasi berdasarkan alokasi
    public function getRekomendasi()
    {
        $persentase = $this->getPersentaseAlokasi();
        $rekomendasi = [];

        // Cek alokasi pembangunan
        if ($persentase['pelaksanaan'] < 30) {
            $rekomendasi[] = "Pertimbangkan untuk meningkatkan alokasi pembangunan infrastruktur";
        }

        // Cek alokasi pemberdayaan
        if ($persentase['pemberdayaan'] < 15) {
            $rekomendasi[] = "Tingkatkan program pemberdayaan masyarakat untuk kesejahteraan";
        }

        // Cek keseimbangan anggaran
        if (!$this->isAnggaranSeimbang()) {
            $rekomendasi[] = "Perlu penyesuaian anggaran karena pengeluaran melebihi pendapatan";
        }

        return $rekomendasi;
    }
}