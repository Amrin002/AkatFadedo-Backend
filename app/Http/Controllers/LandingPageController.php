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

        $apbdes = Cache::remember('apbdes_home', 60, function () {
            return Apbdes::orderByDesc('tahun')->first(); // langsung ambil 1 record terbaru berdasarkan tahun terbesar
        });

        $title = 'Berita Desa';

        return view('home.index', compact('jumlahPenduduk', 'fasilitas', 'strukturDesa', 'galeri', 'berita', 'title', 'jumlahKk', 'apbdes'));
    }

    public function show($slug)
    {
        // Caching berita berdasarkan slug
        $berita = Cache::remember('berita_detail_' . $slug, 60, function () use ($slug) {
            return Berita::where('slug', $slug)->firstOrFail();
        });

        // Hitung view (opsional) - tidak di-cache karena harus realtime
        $sessionKey = 'berita_viewed_' . $berita->id;
        if (!session()->has($sessionKey)) {
            $berita->increment('views');
            session()->put($sessionKey, true);
        }

        // Caching berita terbaru untuk sidebar
        $berita_terbaru = Cache::remember('berita_terbaru_sidebar', 60, function () {
            return Berita::latest()->take(8)->get();
        });

        return view('home.berita', compact('berita', 'berita_terbaru'));
    }

    public function semua(Request $request)
    {
        // Caching per halaman untuk pagination
        $page = $request->get('page', 1);
        $berita = Cache::remember("semua_berita_page_{$page}", 60, function () {
            return Berita::latest()->paginate(6);
        });

        return view('home.daftar-berita', compact('berita'));
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
}
