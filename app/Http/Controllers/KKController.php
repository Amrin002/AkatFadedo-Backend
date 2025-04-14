<?php

namespace App\Http\Controllers;

use App\Exports\KKExport;
use App\Imports\KKImport;
use App\Models\KK;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //~
        $title = 'Halaman KK';
        $halaman = 'KK';
        // $user = auth()->user();
        $user = $request->user();

        // Hanya mengambil data yang belum dihapus (soft delete)
        $kk = KK::whereNotIn('desa', ['admin']) // Sembunyikan berdasarkan nama kepala keluarga
            ->orderByDesc('no_kk')
            ->get();

        return view('kk.index', compact('title', 'halaman', 'kk', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function importKK(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);


        Excel::import(new KKImport, $request->file('file'));

        return back()->with('success', 'Import KK selesai. Data yang sudah ada tidak dimasukkan ulang.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'no_kk' => 'required|string|size:16|unique:kk,no_kk',
            'dusun' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
        ]);

        KK::create([
            'no_kk' => $request->no_kk,
            'dusun' => $request->dusun,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
        ]);

        return redirect()->route('kk.index')->with('success', 'Data KK berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(KK $kK)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KK $kK)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $no_kk)
    {
        //
        $request->validate([

            'dusun' => 'required|string|max:255',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
        ]);
        $kk = KK::findOrFail($no_kk);

        $kk->update([

            'dusun' => $request->dusun,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
        ]);
        return redirect()->route('kk.index')->with('success', 'Data KK berhasil diperbarui.');
    }
    public function export()
    {
        try {
            return Excel::download(new KKExport, 'kkexcel.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        // return 'Ini export';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $no_kk)
    {
        //
        $kk = KK::findOrFail($no_kk);
        $kk->delete();

        return redirect()->route('kk.index')->with('success', 'Data KK berhasil dihapus.');
    }
}
