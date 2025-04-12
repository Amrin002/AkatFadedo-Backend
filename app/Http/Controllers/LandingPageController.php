<?php

namespace App\Http\Controllers;

use App\Models\FasilitasDesa;
use App\Models\Penduduk;
use App\Models\StrukturDesa;
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
        $strukturDesa = StrukturDesa::all();
        $galeri = DB::table('galeri_desas')->get();
        return view('home.index', compact('jumlahPenduduk', 'fasilitas', 'strukturDesa', 'galeri'));
    }
}
