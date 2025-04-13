<?php

namespace App\Http\Controllers;

use App\Exports\PendudukExport;
use App\Imports\PendudukImport;
use App\Models\Penduduk;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $title = 'Halaman Penduduk';
        $halaman = 'Penduduk';
        $user = $request->user();

        // Mengambil semua pengguna tanpa filter devisi atau staf
        $penduduk = Penduduk::whereNotIn('nama_lengkap', ['Admin'])
            ->orderBy('no_kk')
            ->orderByRaw("FIELD(status_keluarga, 'Kepala Keluarga', 'Istri', 'Anak', 'Lainnya')")
            ->orderBy('nama_lengkap')
            ->get();
        return view('penduduk.index', compact('title', 'halaman', 'penduduk', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function importPenduduk(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv,xls',
        ]);
        $import = new PendudukImport();
        Excel::import($import, $request->file('file'));

        $gagal = $import->getGagal();

        if (count($gagal) > 0) {
            return redirect()->back()->with('import_gagal', $gagal);
        }

        return redirect()->back()->with('success', 'Data penduduk berhasil diimport!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validasi data
        $request->validate([
            'no_kk' => 'required|string|max:16|exists:kk,no_kk',
            'nik' => 'required|string|max:16|unique:penduduks,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki,perempuan',
            'agama' => 'required|string',
            'pendidikan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'status_keluarga' => 'nullable|string|max:255',
            'golongan_darah' => 'nullable|string|max:3',
            'kewarganegaraan' => 'required|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|',
            'no_hp' => 'nullable|string|max:15',
        ]);

        $penduduk = Penduduk::create([
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'status' => $request->status,
            'status_keluarga' => $request->status_keluarga,
            'golongan_darah' => $request->golongan_darah,
            'kewarganegaraan' => $request->kewarganegaraan,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
        // dd($penduduk);
        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk berhasil ditambahkan!');
    }

    public function export()
    {
        try {
            return Excel::download(new PendudukExport, 'pendudukexcel.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        // Validasi data
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki,perempuan',
            'agama' => 'required|string',
            'pendidikan' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'status_keluarga' => 'nullable|string|max:255',
            'golongan_darah' => 'nullable|string|max:3',
            'kewarganegaraan' => 'required|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|',
            'no_hp' => 'nullable|string|max:15',
        ]);

        $penduduk = Penduduk::findOrFail($id);
        $penduduk->update([

            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'status' => $request->status,
            'status_keluarga' => $request->status_keluarga,
            'golongan_darah' => $request->golongan_darah,
            'kewarganegaraan' => $request->kewarganegaraan,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penduduk = Penduduk::findOrFail($id);
        $penduduk->delete();
        return redirect()->route('penduduk.index')->with('success', 'Data Penduduk Berhasil dihapus');
    }
}
