<?php

namespace App\Http\Controllers;

use App\Models\SuratLainnya;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SuratLainnyaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Halaman Pengguna';
        $halaman = 'Surat Keterang Orang Tua Tidak Mampu';
        $user = $request->user();

        $suratLainnya = SuratLainnya::all();
        return view('suratlainnya.index', compact('title', 'halaman', 'user', 'suratLainnya'));
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
        Log::info('Masuk ke fungsi store SuratLainnya');

        if (!$request->hasFile('file')) {
            return back()->with('error', 'File terlalu besar atau gagal diupload.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,docx|max:3072', //maximal 3mb
            'status' => 'nullable|in:On Progress,Approve,Cancel',
        ],[
            'file.max' => 'Size file yang anda pilih terlalu besar!',
            'file.mimes' => 'Format file yang anda masukan tidak sesuai!',
        ]);

        $originalFileName = $request->file('file')->getClientOriginalName();

        // Menyimpan file dengan nama asli
        $filePath = $request->file('file')->storeAs('surat_lainnya', $originalFileName, 'public');

        SuratLainnya::create([
        'nama' => $request->nama,
        'keterangan' => $request->keterangan,
        'file' => $filePath, // simpan path file
        'status' => 'On Progress',
        ]);

        return redirect()->route('suratlainnya.index')->with('success', "Surat anda berhasil di tambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratLainnya $suratLainnya)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratLainnya $suratLainnya)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    Log::info("ID yang diterima untuk update: ", ['id' => $id]);

    if (!$request->hasFile('file')) {
        return back()->with('error', 'File terlalu besar atau gagal diupload.');
    }

    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'keterangan' => 'nullable|string',
        'file' => 'nullable|file|mimes:pdf,docx|max:3072',
        'status' => 'nullable|in:On Progress,Approve,Cancel',
    ],[
        'file.max' => 'Size file yang anda pilih terlalu besar!',
        'file.mimes' => 'Format file yang anda masukan tidak sesuai!',
    ]);

    // Menemukan model SuratLainnya berdasarkan ID
    $suratLainnya = SuratLainnya::findOrFail($id);

    // Menyimpan file baru jika ada
    if ($request->hasFile('file')) {
        // Hapus file lama jika ada
        if ($suratLainnya->file) {
            Storage::delete('public/' . $suratLainnya->file);
        }

        $originalFileName = $request->file('file')->getClientOriginalName();

        // Menyimpan file dengan nama asli
        $filePath = $request->file('file')->storeAs('surat_lainnya', $originalFileName, 'public');

    } else {
        // Jika tidak ada file baru, gunakan file lama
        $filePath = $suratLainnya->file;
    }

    // Update data
    $suratLainnya->update([
        'nama' => $request->nama,
        'keterangan' => $request->keterangan,
        'file' => $filePath,
        'status' => $request->status,
    ]);

    return redirect()->route('suratlainnya.index')->with('success', 'Surat berhasil diubah');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Log::info("Masuk ke destroy dengan ID manual:", ['id' => $id]);

        $suratLainnya = SuratLainnya::findOrFail($id);

        if ($suratLainnya->file) {
            Storage::delete('public/' . $suratLainnya->file);
        }

        $suratLainnya->delete();

        return redirect()->route('suratlainnya.index')->with('success', 'Surat berhasil dihapus');
    }
}
