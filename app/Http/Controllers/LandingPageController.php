<?php
namespace App\Http\Controllers;

use App\Models\AppVersion;
use App\Models\FasilitasDesa;
use App\Models\Penduduk;
use App\Models\StrukturDesa;
use App\Models\Berita;
use App\Models\GaleriDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    public function index()
    {
        // Caching jumlah penduduk
        $jumlahPenduduk = Cache::remember('jumlah_penduduk', 60, function () {
            return Penduduk::where('nama_lengkap', '!=', 'Admin')->count();
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
        // Caching latest app version untuk download
        $latestAppVersion = Cache::remember('latest_app_version', 60, function () {
            return AppVersion::getLatestVersion('android');
        });

        $title = 'Berita Desa';

        return view('home.index', compact('jumlahPenduduk', 'fasilitas', 'strukturDesa', 'galeri', 'berita', 'title', 'latestAppVersion'));
    }
    public function downloadApk(Request $request)
    {
        try {
            // Ambil versi terbaru dari database
            $latestAppVersion = AppVersion::getLatestVersion('android');

            if (!$latestAppVersion) {
                // Jika tidak ada versi yang tersedia, redirect dengan error
                return redirect()->back()->with('error', 'Aplikasi belum tersedia untuk download.');
            }

            // Cek apakah file APK ada di storage
            $downloadUrl = $latestAppVersion->download_url;

            // Jika download_url adalah path relatif, cek di storage
            if (!filter_var($downloadUrl, FILTER_VALIDATE_URL)) {
                // Bersihkan path dari storage/ jika ada
                $cleanPath = str_replace('storage/', '', $downloadUrl);
                $filePath = 'public/' . $cleanPath;

                if (!Storage::exists($filePath)) {
                    Log::error('APK file not found', [
                        'download_url' => $downloadUrl,
                        'file_path' => $filePath,
                        'version' => $latestAppVersion->version
                    ]);

                    return redirect()->back()->with('error', 'File aplikasi tidak ditemukan. Silakan hubungi administrator.');
                }

                // Download file dari storage
                $file = Storage::get($filePath);
                $fileName = 'desaku-v' . $latestAppVersion->version . '.apk';

                return response($file, 200, [
                    'Content-Type' => 'application/vnd.android.package-archive',
                    'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                    'Content-Length' => strlen($file),
                    'Cache-Control' => 'no-cache, no-store, must-revalidate',
                    'Pragma' => 'no-cache',
                    'Expires' => '0'
                ]);
            } else {
                // Jika URL eksternal, redirect ke URL tersebut
                return redirect($downloadUrl);
            }

        } catch (\Exception $e) {
            Log::error('Error downloading APK: ' . $e->getMessage(), [
                'error' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunduh aplikasi. Silakan coba lagi.');
        }
    }
    public function checkAppAvailability()
    {
        try {
            $latestAppVersion = AppVersion::getLatestVersion('android');

            if (!$latestAppVersion) {
                return response()->json([
                    'available' => false,
                    'message' => 'Aplikasi belum tersedia'
                ]);
            }

            $downloadUrl = $latestAppVersion->download_url;
            $fileExists = false;

            // Cek apakah file ada
            if (!filter_var($downloadUrl, FILTER_VALIDATE_URL)) {
                $cleanPath = str_replace('storage/', '', $downloadUrl);
                $filePath = 'public/' . $cleanPath;
                $fileExists = Storage::exists($filePath);
            } else {
                $fileExists = true; // Asumsikan URL eksternal valid
            }

            return response()->json([
                'available' => $fileExists,
                'version' => $latestAppVersion->version,
                'file_size' => $latestAppVersion->file_size,
                'changelog' => $latestAppVersion->changelog_array,
                'download_url' => route('download.apk')
            ]);

        } catch (\Exception $e) {
            Log::error('Error checking app availability: ' . $e->getMessage());

            return response()->json([
                'available' => false,
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
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
            'umum' => ['nama' => 'Umum', 'icon' => 'fas fa-bullhorn'],
            'politik' => ['nama' => 'Politik', 'icon' => 'fas fa-landmark'],
            'ekonomi' => ['nama' => 'Ekonomi', 'icon' => 'fas fa-coins'],
            'olahraga' => ['nama' => 'Olahraga', 'icon' => 'fas fa-futbol'],
            'teknologi' => ['nama' => 'Teknologi', 'icon' => 'fas fa-microchip'],
            'pendidikan' => ['nama' => 'Pendidikan', 'icon' => 'fas fa-graduation-cap'],
            'kesehatan' => ['nama' => 'Kesehatan', 'icon' => 'fas fa-heartbeat'],
            'pembangunan' => ['nama' => 'Pembangunan', 'icon' => 'fas fa-tools'],
            'pertanian' => ['nama' => 'Pertanian', 'icon' => 'fas fa-tractor'],
            'perikanan' => ['nama' => 'Perikanan', 'icon' => 'fas fa-fish'],
            'lingkungan' => ['nama' => 'Lingkungan', 'icon' => 'fas fa-leaf'],
            'pariwisata' => ['nama' => 'Pariwisata', 'icon' => 'fas fa-umbrella-beach'],
            'transportasi' => ['nama' => 'Transportasi', 'icon' => 'fas fa-bus'],
            'hiburan' => ['nama' => 'Hiburan', 'icon' => 'fas fa-film'],
            'budaya' => ['nama' => 'Budaya', 'icon' => 'fas fa-theater-masks'],
            'musik' => ['nama' => 'Musik', 'icon' => 'fas fa-music'],
            'film' => ['nama' => 'Film', 'icon' => 'fas fa-video'],
            'agama' => ['nama' => 'Agama', 'icon' => 'fas fa-mosque'],
            'opini' => ['nama' => 'Opini', 'icon' => 'fas fa-pen-nib'],
            'sosial' => ['nama' => 'Sosial', 'icon' => 'fas fa-users'],
            'startup' => ['nama' => 'Startup', 'icon' => 'fas fa-lightbulb'],
            'umkm' => ['nama' => 'UMKM', 'icon' => 'fas fa-store'],
        ];

        // Normalisasi string kategori dari DB agar cocok dengan key array
        $kategoriKey = strtolower(trim($berita->kategori));

        return view('home.berita', compact('berita', 'berita_terbaru', 'kategoriData', 'kategoriKey'));
    }



    public function semua(Request $request)
    {
        $page = $request->get('page', 1);
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
            'berita_terbaru_sidebar',
            'latest_app_version'
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
}