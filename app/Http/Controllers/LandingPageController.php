<?php

namespace App\Http\Controllers;

use App\Models\FasilitasDesa;
use App\Models\Penduduk;
use App\Models\StrukturDesa;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        //
        $jumlahPenduduk = Penduduk::where('nama_lengkap', '!=', 'Admin')->count();
        $fasilitas = FasilitasDesa::first();
        $strukturDesa = StrukturDesa::latest()->take(6)->get();
        $galeri = DB::table('galeri_desas')->get();
        $berita = Berita::latest()->take(6)->get();
        $title = 'Berita Desa'; // definisikan variabel $title
        return view('home.index', compact('jumlahPenduduk', 'fasilitas', 'strukturDesa', 'galeri', 'berita', 'title'));
    }

    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->firstOrFail();
    // Hitung view (opsional)
    $sessionKey = 'berita_viewed_' . $berita->id;

    // Cek apakah berita ini sudah pernah dilihat dalam sesi ini
    if (!session()->has($sessionKey)) {
        $berita->increment('views');
        session()->put($sessionKey, true);
    }

    $berita_terbaru = Berita::latest()->take(8)->get();

    return view('home.berita', compact('berita', 'berita_terbaru'));
    }
    
    public function semua()
    {
        $berita = Berita::latest()->paginate(6); // Sesuaikan jumlah per halaman
        return view('home.daftar-berita', compact('berita'));
    }

    public function galeri()  
    {
        $strukturDesa = StrukturDesa::all();
        return view('home.daftar-struktur-desa', compact('strukturDesa'));

    }


}
