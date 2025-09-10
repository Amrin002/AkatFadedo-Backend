<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'no_kk',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pendidikan',
        'pekerjaan',
        'status',
        'status_keluarga',
        'golongan_darah',
        'kewarganegaraan',
        'nama_ayah',
        'nama_ibu',
        'email',
        'no_hp',
    ];

    protected $dates = [
        'tanggal_lahir',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi
    public function user()
    {
        return $this->hasOne(User::class, 'penduduk_id', 'id');
    }

    public function kk()
    {
        return $this->belongsTo(KK::class, 'no_kk', 'no_kk');
    }

    // Scope untuk mengecualikan admin
    public function scopeExcludeAdmin($query)
    {
        return $query->where('nama_lengkap', '!=', 'Admin');
    }

    // Method untuk menghitung umur
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) {
            return null;
        }
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    // Method untuk mendapatkan kategori umur berdasarkan standar IDM
    public function getKategoriUmurAttribute()
    {
        $umur = $this->umur;
        
        if ($umur === null) {
            return 'tidak_diketahui';
        }

        if ($umur < 15) {
            return 'anak_anak';
        } elseif ($umur >= 15 && $umur < 65) {
            return 'usia_produktif';
        } else {
            return 'lansia';
        }
    }

    // Method untuk cek apakah termasuk anak-anak (< 15 tahun)
    public function isAnakAnak()
    {
        return $this->umur !== null && $this->umur < 15;
    }

    // Method untuk cek apakah termasuk usia produktif (15-64 tahun)
    public function isUsiaProduktif()
    {
        $umur = $this->umur;
        return $umur !== null && $umur >= 15 && $umur < 65;
    }

    // Method untuk cek apakah termasuk lansia (>= 65 tahun)
    public function isLansia()
    {
        $umur = $this->umur;
        return $umur !== null && $umur >= 65;
    }

    // Scope untuk filter berdasarkan kategori umur (dengan pengecualian admin)
    public function scopeAnakAnak($query)
    {
        return $query->excludeAdmin()
                     ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 15');
    }

    public function scopeUsiaProduktif($query)
    {
        return $query->excludeAdmin()
                     ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 15')
                     ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 65');
    }

    public function scopeLansia($query)
    {
        return $query->excludeAdmin()
                     ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 65');
    }

    // Method static untuk mendapatkan statistik demografis (dengan pengecualian admin)
    public static function getStatistikDemografi()
    {
        $total = self::excludeAdmin()->count();
        $anakAnak = self::anakAnak()->count();
        $usiaProduktif = self::usiaProduktif()->count();
        $lansia = self::lansia()->count();

        return [
            'total_penduduk' => $total,
            'anak_anak' => [
                'jumlah' => $anakAnak,
                'persentase' => $total > 0 ? round(($anakAnak / $total) * 100, 2) : 0
            ],
            'usia_produktif' => [
                'jumlah' => $usiaProduktif,
                'persentase' => $total > 0 ? round(($usiaProduktif / $total) * 100, 2) : 0
            ],
            'lansia' => [
                'jumlah' => $lansia,
                'persentase' => $total > 0 ? round(($lansia / $total) * 100, 2) : 0
            ]
        ];
    }

    // Method untuk rasio ketergantungan (dependency ratio) - penting untuk IDM (dengan pengecualian admin)
    // Method untuk rasio ketergantungan (dependency ratio) - penting untuk IDM (dengan pengecualian admin)
    public static function getRasioKetergantungan()
    {
        $usiaProduktif = self::usiaProduktif()->count();
        $anakAnak = self::anakAnak()->count();
        $lansia = self::lansia()->count();
        
        // Selalu return array, jangan return 0 langsung
        if ($usiaProduktif == 0) {
            return [
                'rasio_ketergantungan_total' => 0,
                'rasio_ketergantungan_anak' => 0,
                'rasio_ketergantungan_lansia' => 0
            ];
        }

        $rasioKetergantunganTotal = (($anakAnak + $lansia) / $usiaProduktif) * 100;
        $rasioKetergantunganAnak = ($anakAnak / $usiaProduktif) * 100;
        $rasioKetergantunganLansia = ($lansia / $usiaProduktif) * 100;

        return [
            'rasio_ketergantungan_total' => round($rasioKetergantunganTotal, 2),
            'rasio_ketergantungan_anak' => round($rasioKetergantunganAnak, 2),
            'rasio_ketergantungan_lansia' => round($rasioKetergantunganLansia, 2)
        ];
    }
    // Method untuk mendapatkan data berdasarkan jenis kelamin dan kategori umur (dengan pengecualian admin)
    public static function getStatistikGenderDanUmur()
    {
        $data = [
            'laki_laki' => [
                'anak_anak' => self::where('jenis_kelamin', 'Laki-laki')->anakAnak()->count(),
                'usia_produktif' => self::where('jenis_kelamin', 'Laki-laki')->usiaProduktif()->count(),
                'lansia' => self::where('jenis_kelamin', 'Laki-laki')->lansia()->count(),
            ],
            'perempuan' => [
                'anak_anak' => self::where('jenis_kelamin', 'Perempuan')->anakAnak()->count(),
                'usia_produktif' => self::where('jenis_kelamin', 'Perempuan')->usiaProduktif()->count(),
                'lansia' => self::where('jenis_kelamin', 'Perempuan')->lansia()->count(),
            ]
        ];

        // Hitung total untuk setiap gender
        $data['laki_laki']['total'] = array_sum($data['laki_laki']);
        $data['perempuan']['total'] = array_sum($data['perempuan']);

        return $data;
    }

    // Method untuk mendapatkan piramida penduduk (age pyramid data) (dengan pengecualian admin)
    public static function getPiramidaPenduduk()
    {
        $kelompokUmur = [
            '0-4' => [0, 4],
            '5-9' => [5, 9],
            '10-14' => [10, 14],
            '15-19' => [15, 19],
            '20-24' => [20, 24],
            '25-29' => [25, 29],
            '30-34' => [30, 34],
            '35-39' => [35, 39],
            '40-44' => [40, 44],
            '45-49' => [45, 49],
            '50-54' => [50, 54],
            '55-59' => [55, 59],
            '60-64' => [60, 64],
            '65-69' => [65, 69],
            '70-74' => [70, 74],
            '75+' => [75, 150]
        ];

        $piramida = [];

        foreach ($kelompokUmur as $kelompok => $range) {
            $lakiLaki = self::excludeAdmin()
                ->where('jenis_kelamin', 'Laki-laki')
                ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= ?', [$range[0]])
                ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= ?', [$range[1]])
                ->count();

            $perempuan = self::excludeAdmin()
                ->where('jenis_kelamin', 'Perempuan')
                ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= ?', [$range[0]])
                ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) <= ?', [$range[1]])
                ->count();

            $piramida[$kelompok] = [
                'laki_laki' => $lakiLaki,
                'perempuan' => $perempuan,
                'total' => $lakiLaki + $perempuan
            ];
        }

        return $piramida;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($penduduk) {
            // Hapus relasi user jika ada
            if ($penduduk->user) {
                $penduduk->user->delete();
            }
        });
    }
}