<?php

namespace App\Http\Controllers;

use App\Models\KK;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        //
        $title = 'Halaman Utama';
        $user = $request->user(); // Ambil data user yang login
        $totalUser = User::count();
        $jumlahkk = KK::count();
        $perempuan = Penduduk::where('jenis_kelamin', 'perempuan')->count();
        $laki = Penduduk::where('jenis_kelamin', 'laki')->where('nama_lengkap', '!=', 'Admin')->count();
        $jmlpenduduk = Penduduk::where('nama_lengkap', '!=', 'Admin')->count();
        return view('admin.index', compact(
            'title',
            'user',
            'totalUser',
            'jumlahkk',
            'perempuan',
            'laki',
            'jmlpenduduk'
        ));
    }
}
