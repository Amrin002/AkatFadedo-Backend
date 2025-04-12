<?php

namespace App\Http\Controllers;

use App\Models\FasilitasDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FasilitasDesaController extends Controller
{
    public function index(Request $request)
    {
        //
        $title = 'Halaman Fasilitas Desa';
        $halaman = 'Fasilitas Desa';
        $user = $request->user();
        $fasilitas = DB::table('fasilitas_desas')->get();
        return view('fasilitas.index', compact('title', 'halaman', 'user', 'fasilitas'));
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
        $request->validate([
            'fasilitas_pendidikan' => 'required|integer',
            'fasilitas_kesehatan' => 'required|integer',
            'luas_wilayah' => 'required|numeric'
        ]);

        FasilitasDesa::create([
            'fasilitas_pendidikan' => $request->fasilitas_pendidikan,
            'fasilitas_kesehatan' => $request->fasilitas_kesehatan,
            'luas_wilayah' => $request->luas_wilayah
        ]);

        return redirect()->route('fasilitas.index')->with('success', 'Data Fasilitas Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FasilitasDesa $fasilitasDesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FasilitasDesa $fasilitasDesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        $request->validate([
            'fasilitas_pendidikan' => 'required|integer',
            'fasilitas_kesehatan' => 'required|integer',
            'luas_wilayah' => 'required|numeric'
        ]);

        $fasilitas = FasilitasDesa::findOrFail($id);
        $fasilitas->update([
            'fasilitas_pendidikan' => $request->fasilitas_pendidikan,
            'fasilitas_kesehatan' => $request->fasilitas_kesehatan,
            'luas_wilayah' => $request->luas_wilayah
        ]);
        return redirect()->route('fasilitas.index')->with('success', 'Data Fasilitas Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $fasilitas = FasilitasDesa::findOrFail($id);
        $fasilitas->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Data Berhasil Dihapus');
    }
}
