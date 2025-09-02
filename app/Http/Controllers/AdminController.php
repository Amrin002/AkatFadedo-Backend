<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\Penduduk;
use App\Models\SuratDomisili;
use App\Models\SuratKtm;
use App\Models\SuratKtu;
use App\Models\SuratPindah;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $title = 'Halaman Utama';
        $user = $request->user(); 
        $totalUser = User::where('role', '!=', 'admin')->count();
        $jumlahkk = KK::where('desa', '!=', 'Admin')->count();
        $jumlahSurat = SuratKtm::whereNotNull('no_surat')->count()
            + SuratKtu::whereNotNull('no_surat')->count()
            + SuratDomisili::whereNotNull('no_surat')->count()
            + SuratPindah::whereNotNull('no_surat')->count();
        $perempuan = Penduduk::where('jenis_kelamin', 'perempuan')->count();
        $laki = Penduduk::where('jenis_kelamin', 'Laki-laki')->where('nama_lengkap', '!=', 'Admin')->count();
        $jmlpenduduk = Penduduk::where('nama_lengkap', '!=', 'Admin')->count();
        return view('admin.index', compact(
            'title',
            'user',
            'totalUser',
            'jumlahkk',
            'perempuan',
            'laki',
            'jmlpenduduk',
            'jumlahSurat'
        ));
    }
}
