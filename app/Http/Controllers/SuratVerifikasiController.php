<?php

namespace App\Http\Controllers;

use App\Models\SuratKtm;
use App\Models\SuratVerifikasi;
use Illuminate\Http\Request;

class SuratVerifikasiController extends Controller
{
    /**
     * Verifikasi surat berdasarkan token
     */
    public function verifikasi($token)
    {
        // Coba verifikasi untuk berbagai model surat
        $modelClasses = [
            SuratKtm::class,
            // Tambahkan model surat lain di sini nanti
        ];

        foreach ($modelClasses as $modelClass) {
            $verifikasi = $modelClass::verifikasi($token);

            if ($verifikasi) {
                return view('verifikasi.detail', compact('verifikasi'));
            }
        }

        // Jika token tidak valid di semua model
        return view('verifikasi.tidak-valid');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suratVerifikasi = SuratVerifikasi::orderBy('created_at', 'desc')->get();
        return view('verifikasi.index', compact('suratVerifikasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratVerifikasi $suratVerifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratVerifikasi $suratVerifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratVerifikasi $suratVerifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $verifikasi = SuratVerifikasi::findOrFail($id);
        $verifikasi->delete();

        return redirect()->route('verifikasi.index')
            ->with('success', 'Riwayat verifikasi berhasil dihapus');
    }
}
