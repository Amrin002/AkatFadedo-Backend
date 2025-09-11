<?php
namespace App\Http\Controllers;

use App\Models\Apbdes;
use App\Models\FasilitasDesa;
use App\Models\Penduduk;
use App\Models\StrukturDesa;
use App\Models\Berita;
use App\Models\GaleriDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingPageController extends Controller
{
    public function index()
    {
        // Caching jumlah penduduk
        $jumlahPenduduk = Cache::remember('jumlah_penduduk', 60, function () {
            return Penduduk::where('nama_lengkap', '!=', 'Admin')->count();
        });
        $jumlahKk = Cache::remember('jumlah_kk', 60, function () {
            return Penduduk::where('status_keluarga', 'Kepala Keluarga')->where('nama_lengkap', '!=', 'Admin')->count();
        });
        // Caching jumlah laki-laki
        $jumlahLakiLaki = Cache::remember('jumlah_laki_laki', 60, function () {
            return Penduduk::where('jenis_kelamin', 'Laki-laki')
                ->where('nama_lengkap', '!=', 'Admin')
                ->count();
        });

        // Caching jumlah perempuan
        $jumlahPerempuan = Cache::remember('jumlah_perempuan', 60, function () {
            return Penduduk::where('jenis_kelamin', 'Perempuan')
                ->where('nama_lengkap', '!=', 'Admin')
                ->count();
        });

        // Caching fasilitas desa
        $fasilitas = Cache::remember('fasilitas_home', 60, function () {
            return FasilitasDesa::first();
        });

        // Caching struktur desa untuk homepage
        $strukturDesa = Cache::remember('struktur_desa_home', 60, function () {
            return StrukturDesa::latest()->take(6)->get();
        });

        // Caching galeri desa untuk homepage - gunakan Eloquent
        $galeri = Cache::remember('galeri_home', 60, function () {
            return GaleriDesa::latest()->take(8)->get(); // Ambil beberapa saja untuk homepage
        });

        // Caching berita untuk homepage
        $berita = Cache::remember('berita_home', 60, function () {
            return Berita::latest()->take(6)->get();
        });
        $apbdes = Cache::remember('apbdes_analisis', 60, function () {
            return Apbdes::orderByDesc('tahun')->first();
        });

        $title = 'Berita Desa';
        
        return view('home.index', compact('jumlahPenduduk', 'fasilitas', 'strukturDesa', 'galeri', 'berita', 'title', 'jumlahKk', 'jumlahLakiLaki', 'jumlahPerempuan', 'apbdes'));
    }

    public function show($slug)
{
    // Ambil berita by slug + cache
    $berita = Cache::remember('berita_detail_' . $slug, 60, function () use ($slug) {
        return Berita::where('slug', $slug)->firstOrFail();
    });

    // Hitung view (real-time)
    $sessionKey = 'berita_viewed_' . $berita->id;
    if (!session()->has($sessionKey)) {
        $berita->increment('views');
        session()->put($sessionKey, true);
    }

    // Berita terbaru untuk sidebar
    $berita_terbaru = Cache::remember('berita_terbaru_sidebar', 60, function () {
        return Berita::latest()->take(8)->get();
    });

    // Data kategori (mapping manual)
    $kategoriData = [
        'umum'         => ['nama' => 'Umum', 'icon' => 'fas fa-bullhorn'],
        'politik'      => ['nama' => 'Politik', 'icon' => 'fas fa-landmark'],
        'ekonomi'      => ['nama' => 'Ekonomi', 'icon' => 'fas fa-coins'],
        'olahraga'     => ['nama' => 'Olahraga', 'icon' => 'fas fa-futbol'],
        'teknologi'    => ['nama' => 'Teknologi', 'icon' => 'fas fa-microchip'],
        'pendidikan'   => ['nama' => 'Pendidikan', 'icon' => 'fas fa-graduation-cap'],
        'kesehatan'    => ['nama' => 'Kesehatan', 'icon' => 'fas fa-heartbeat'],
        'pembangunan'  => ['nama' => 'Pembangunan', 'icon' => 'fas fa-tools'],
        'pertanian'    => ['nama' => 'Pertanian', 'icon' => 'fas fa-tractor'],
        'perikanan'    => ['nama' => 'Perikanan', 'icon' => 'fas fa-fish'],
        'lingkungan'   => ['nama' => 'Lingkungan', 'icon' => 'fas fa-leaf'],
        'pariwisata'   => ['nama' => 'Pariwisata', 'icon' => 'fas fa-umbrella-beach'],
        'transportasi' => ['nama' => 'Transportasi', 'icon' => 'fas fa-bus'],
        'hiburan'      => ['nama' => 'Hiburan', 'icon' => 'fas fa-film'],
        'budaya'       => ['nama' => 'Budaya', 'icon' => 'fas fa-theater-masks'],
        'musik'        => ['nama' => 'Musik', 'icon' => 'fas fa-music'],
        'film'         => ['nama' => 'Film', 'icon' => 'fas fa-video'],
        'agama'        => ['nama' => 'Agama', 'icon' => 'fas fa-mosque'],
        'opini'        => ['nama' => 'Opini', 'icon' => 'fas fa-pen-nib'],
        'sosial'       => ['nama' => 'Sosial', 'icon' => 'fas fa-users'],
        'startup'      => ['nama' => 'Startup', 'icon' => 'fas fa-lightbulb'],
        'umkm'         => ['nama' => 'UMKM', 'icon' => 'fas fa-store'],
    ];

    // Normalisasi string kategori dari DB agar cocok dengan key array
    $kategoriKey = strtolower(trim($berita->kategori));

    return view('home.berita', compact('berita', 'berita_terbaru', 'kategoriData', 'kategoriKey'));
}



public function semua(Request $request)
{
    $page     = $request->get('page', 1);
    $kategori = $request->get('kategori'); // ambil filter kategori dari query

    // key cache per halaman + filter kategori (biar tidak bentrok)
    $cacheKey = "semua_berita_page_{$page}_kategori_" . ($kategori ?? 'all');

    $berita = Cache::remember($cacheKey, 60, function () use ($kategori) {
        $query = Berita::latest();

        if ($kategori) {
            // filter berdasarkan string kategori yang disimpan di kolom "kategori"
            $query->where('kategori', $kategori);
        }

        return $query->paginate(6);
    });

    // ambil daftar kategori dari config, buat array keyed by nama
    $kategoriData = collect(config('kategori'))
        ->mapWithKeys(function ($item) {
            return [$item['nama'] => $item];
        })
        ->toArray();

    return view('home.daftar-berita', compact('berita', 'kategoriData'));
}

    public function struktur()
    {
        // Caching semua struktur desa
        $strukturDesa = Cache::remember('struktur_desa_all', 60, function () {
            return StrukturDesa::orderBy('urutan')->get(); // Tambahkan ordering jika ada field urutan
        });

        return view('home.daftar-struktur-desa', compact('strukturDesa'));
    }

    public function galeri(Request $request)
    {
        // Caching galeri dengan pagination
        $page = $request->get('page', 1);
        $galeri = Cache::remember("galeri_page_{$page}", 60, function () {
            return GaleriDesa::latest()->paginate(6);
        });

        return view('home.daftar-galeri', compact('galeri'));
    }

    public function apbdes()
    {
        return view('home.apbdes-view', compact('apbdes'));
    }

    /**
     * Method untuk clear cache ketika data diupdate
     * Panggil method ini di observer/event listener model
     */
    public static function clearHomeCache()
    {
        $cacheKeys = [
            'jumlah_penduduk',
            'fasilitas_home',
            'struktur_desa_home',
            'struktur_desa_all',
            'galeri_home',
            'berita_home',
            'berita_terbaru_sidebar'
        ];

        foreach ($cacheKeys as $key) {
            Cache::forget($key);
        }

        // Clear paginated cache (contoh untuk 10 halaman pertama)
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget("semua_berita_page_{$i}");
            Cache::forget("galeri_page_{$i}");
        }
    }

    /**
     * Clear cache untuk berita tertentu
     */
    public static function clearBeritaCache($slug)
    {
        Cache::forget('berita_detail_' . $slug);
        Cache::forget('berita_home');
        Cache::forget('berita_terbaru_sidebar');

        // Clear paginated berita cache
        for ($i = 1; $i <= 10; $i++) {
            Cache::forget("semua_berita_page_{$i}");
        }
    }
    public function privacy()
    {
        return view('home.privacy');
    }

    public function profilDesa()
    {
        try {
            // Cache statistik demografis lengkap
            $statistikDemografi = Cache::remember('statistik_demografi', 60, function () {
                return Penduduk::getStatistikDemografi();
            });

            // Cache rasio ketergantungan dengan validasi
            $rasioKetergantungan = Cache::remember('rasio_ketergantungan', 60, function () {
                $result = Penduduk::getRasioKetergantungan();
                
                // Debug: log hasil untuk memastikan formatnya benar
                \Log::info('Cache rasio_ketergantungan result:', $result);
                
                // Validasi hasil - pastikan mengembalikan array
                if (!is_array($result)) {
                    \Log::error('getRasioKetergantungan tidak mengembalikan array', ['result' => $result]);
                    // Return default structure jika bukan array
                    return [
                        'rasio_ketergantungan_total' => 0,
                        'rasio_ketergantungan_anak' => 0,
                        'rasio_ketergantungan_lansia' => 0
                    ];
                }
                
                return $result;
            });

            // Cache statistik gender dan umur dengan validasi
            $statistikGender = Cache::remember('statistik_gender', 60, function () {
                $result = Penduduk::getStatistikGenderDanUmur();
                
                // Debug: log hasil untuk memastikan formatnya benar
                \Log::info('Cache statistik_gender result:', $result);
                
                // Validasi hasil
                if (!is_array($result)) {
                    \Log::error('getStatistikGenderDanUmur tidak mengembalikan array', ['result' => $result]);
                    // Return default structure jika bukan array
                    return [
                        'laki_laki' => ['total' => 0, 'anak_anak' => 0, 'usia_produktif' => 0, 'lansia' => 0],
                        'perempuan' => ['total' => 0, 'anak_anak' => 0, 'usia_produktif' => 0, 'lansia' => 0]
                    ];
                }
                
                return $result;
            });

            // Cache jumlah KK - menggunakan scope excludeAdmin untuk konsistensi
            $jumlahKk = Cache::remember('jumlah_kk_profil', 60, function () {
                return Penduduk::excludeAdmin()
                    ->where('status_keluarga', 'Kepala Keluarga')
                    ->count();
            });

            // Validasi data sebelum mengakses
            if (!is_array($statistikGender) || !isset($statistikGender['perempuan']['total']) || !isset($statistikGender['laki_laki']['total'])) {
                \Log::error('statistikGender invalid structure', ['data' => $statistikGender]);
                $statistikGender = [
                    'laki_laki' => ['total' => 0],
                    'perempuan' => ['total' => 0]
                ];
            }

            if (!is_array($rasioKetergantungan) || !isset($rasioKetergantungan['rasio_ketergantungan_total'])) {
                \Log::error('rasioKetergantungan invalid structure', ['data' => $rasioKetergantungan]);
                $rasioKetergantungan = [
                    'rasio_ketergantungan_total' => 0,
                    'rasio_ketergantungan_anak' => 0,
                    'rasio_ketergantungan_lansia' => 0
                ];
            }

            // Hitung Sex Ratio dengan safe access
            $perempuanTotal = $statistikGender['perempuan']['total'] ?? 0;
            $lakiLakiTotal = $statistikGender['laki_laki']['total'] ?? 0;
            $sexRatio = $perempuanTotal > 0 ? 
                round(($lakiLakiTotal / $perempuanTotal) * 100, 2) : 0;

            // Rata-rata anggota per KK
            $totalPenduduk = $statistikDemografi['total_penduduk'] ?? 0;
            $rataAnggotaKK = $jumlahKk > 0 ? round($totalPenduduk / $jumlahKk, 2) : 0;

            // Cache APBDes terbaru dengan data analisis
            $apbdes = Cache::remember('apbdes_analisis', 60, function () {
                return Apbdes::orderByDesc('tahun')->first();
            });

            // Data analisis APBDes menggunakan method baru
            $analisisApbdes = null;
            if ($apbdes) {
                try {
                    $analisisApbdes = [
                        'persentase_alokasi' => $apbdes->getPersentaseAlokasi(),
                        'total_pengeluaran' => $apbdes->total_pengeluaran,
                        'sisa_anggaran' => $apbdes->sisa_anggaran,
                        'persentase_realisasi' => $apbdes->persentase_realisasi,
                        'bidang_terbesar' => $apbdes->bidang_terbesar,
                        'is_seimbang' => $apbdes->isAnggaranSeimbang(),
                        'rekomendasi' => $apbdes->getRekomendasi(),
                        'tren' => Apbdes::getTrenAnggaran($apbdes->tahun)
                    ];
                } catch (\Exception $e) {
                    \Log::error('Error generating APBDes analysis: ' . $e->getMessage());
                    $analisisApbdes = null;
                }
            }

            // Cache fasilitas desa
            $fasilitas = Cache::remember('fasilitas_profil', 60, function () {
                return FasilitasDesa::first();
            });

            // Data persebaran wilayah (hardcode sementara karena tidak ada field RT/RW detail)
            $persebaranWilayah = $this->getPersebaranWilayah();

            // Analisis IDM sederhana berdasarkan data
            $analisisIdm = $this->generateAnalisisIdm($statistikDemografi, $rasioKetergantungan, $sexRatio);

            $title = 'Profil Desa Akat Fadedo';

            return view('home.profil-desa', compact(
                'statistikDemografi',
                'rasioKetergantungan',
                'statistikGender',
                'jumlahKk',
                'sexRatio',
                'rataAnggotaKK',
                'apbdes',
                'analisisApbdes',
                'fasilitas',
                'persebaranWilayah',
                'analisisIdm',
                'title'
            ));

        } catch (\Exception $e) {
            \Log::error('Error in profilDesa method:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Return view dengan data default atau redirect dengan error message
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat profil desa: ' . $e->getMessage());
        }
    }

    /**
     * Generate data persebaran wilayah
     * TODO: Nanti bisa diambil dari database jika ada data RT/RW detail
     */
    private function getPersebaranWilayah()
    {
        // Sementara hardcode, nanti bisa diambil dari model KK
        // dengan query GROUP BY dusun, rt, rw
        return [
            'utara' => ['total_kk' => 83, 'total_jiwa' => 330, 'rw' => '001'],
            'selatan' => ['total_kk' => 93, 'total_jiwa' => 368, 'rw' => '002'],
            'timur' => ['total_kk' => 82, 'total_jiwa' => 326, 'rw' => '003'],
            'barat' => ['total_kk' => 54, 'total_jiwa' => 213, 'rw' => '004']
        ];
    }

    /**
     * Generate analisis IDM berdasarkan data real
     */
    private function generateAnalisisIdm($statistikDemografi, $rasioKetergantungan, $sexRatio)
    {
        $skor = 0;
        $kategori = 'TERTINGGAL';

        try {
            // Pastikan data valid sebelum digunakan
            $usiaProduktifPersentase = $statistikDemografi['usia_produktif']['persentase'] ?? 0;
            $rasioKetergantunganTotal = $rasioKetergantungan['rasio_ketergantungan_total'] ?? 0;

            // Scoring berdasarkan indikator
            if ($usiaProduktifPersentase >= 65) {
                $skor += 25;
            } elseif ($usiaProduktifPersentase >= 60) {
                $skor += 15;
            } else {
                $skor += 5;
            }

            if ($rasioKetergantunganTotal <= 50) {
                $skor += 25;
            } elseif ($rasioKetergantunganTotal <= 70) {
                $skor += 15;
            } else {
                $skor += 5;
            }

            if ($sexRatio >= 95 && $sexRatio <= 105) {
                $skor += 25;
            } else {
                $skor += 10;
            }

            // Tambahan skor base
            $skor += 25;

            // Tentukan kategori
            if ($skor >= 80) {
                $kategori = 'MANDIRI';
            } elseif ($skor >= 65) {
                $kategori = 'MAJU';
            } elseif ($skor >= 50) {
                $kategori = 'BERKEMBANG';
            }

            return [
                'skor' => $skor,
                'kategori' => $kategori,
                'bonus_demografi' => $usiaProduktifPersentase >= 65 ? 'Optimal' : 'Sedang',
                'sex_ratio_status' => ($sexRatio >= 95 && $sexRatio <= 105) ? 'Seimbang' : 'Tidak Seimbang'
            ];

        } catch (\Exception $e) {
            \Log::error('Error generating IDM analysis: ' . $e->getMessage());
            
            // Return default values jika terjadi error
            return [
                'skor' => 0,
                'kategori' => 'TERTINGGAL',
                'bonus_demografi' => 'Sedang',
                'sex_ratio_status' => 'Tidak Seimbang'
            ];
        }
    }
}