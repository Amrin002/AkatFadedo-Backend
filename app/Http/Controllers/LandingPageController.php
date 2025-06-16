<?php

namespace App\Http\Controllers;

use App\Models\FasilitasDesa;
use App\Models\Penduduk;
use App\Models\StrukturDesa;
use App\Models\Berita;
use App\Models\GaleriDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{

    public function index()
    {
        // Caching jumlah penduduk
        $jumlahPenduduk = Cache::remember('jumlah_penduduk', 60, function () {
            return Penduduk::where('nama_lengkap', '!=', 'Admin')->count();
        });

        // Caching fasilitas desa
        $fasilitas = Cache::remember('fasilitas', 60, function () {
            return FasilitasDesa::first();
        });

        // Caching struktur desa
        $strukturDesa = Cache::remember('struktur_desa', 60, function () {
            return StrukturDesa::latest()->take(6)->get();
        });

        // Caching galeri desa
        $galeri = Cache::remember('galeri', 60, function () {
            return DB::table('galeri_desas')->get();
        });

        // Caching berita
        $berita = Cache::remember('berita', 60, function () {
            return Berita::latest()->take(6)->get();
        });

        $title = 'Berita Desa';

        return view('home.index', compact('jumlahPenduduk', 'fasilitas', 'strukturDesa', 'galeri', 'berita', 'title'));
    }

    public function show($slug)
    {
        // Caching berita berdasarkan slug
        $berita = Cache::remember('berita_' . $slug, 60, function () use ($slug) {
            return Berita::where('slug', $slug)->firstOrFail();
        });

        // Hitung view (opsional)
        $sessionKey = 'berita_viewed_' . $berita->id;
        if (!session()->has($sessionKey)) {
            $berita->increment('views');
            session()->put($sessionKey, true);
        }

        // Caching berita terbaru
        $berita_terbaru = Cache::remember('berita_terbaru', 60, function () {
            return Berita::latest()->take(8)->get();
        });

        return view('home.berita', compact('berita', 'berita_terbaru'));
    }


    public function semua()
    {
        // Caching daftar berita
        $berita = Cache::remember('semua_berita', 60, function () {
            return Berita::latest()->paginate(6);
        });

        return view('home.daftar-berita', compact('berita'));
    }


    public function struktur()
    {
        // Caching struktur desa
        $strukturDesa = Cache::remember('struktur_desa_all', 60, function () {
            return StrukturDesa::all();
        });

        return view('home.daftar-struktur-desa', compact('strukturDesa'));
    }


    public function galeri()
    {
        // Caching galeri desa
        $galeri = Cache::remember('galeri', 60, function () {
            return GaleriDesa::latest()->paginate(6);
        });

        return view('home.daftar-galeri', compact('galeri'));
    }

    public function apbdes()
    {
        return view('home.apbdes-view', compact('apbdes'));
    }
}
