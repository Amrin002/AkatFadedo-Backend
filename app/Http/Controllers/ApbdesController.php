<?php

namespace App\Http\Controllers;

use App\Models\Apbdes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class ApbdesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $title = 'Halaman Pengguna';
        $halaman = 'APBDes';
        $user = $request->user();

        $apbdes = Apbdes::orderBy('created_at', 'desc')->get();
        return view('apbdes.index', compact('title', 'halaman', 'user', 'apbdes'));
    }

    public function viewUser(Request $request)
    {
        $daftarTahun = Apbdes::select('tahun')->distinct()->orderByDesc('tahun')->pluck('tahun')->toArray();

        // Cek jika tidak ada data sama sekali
        if (empty($daftarTahun)) {
            return view('apbdes.apbdes-view', [
                'daftarTahun' => [],
                'apbdes' => [],
                'tahunDipilih' => null,
                'message' => 'Maaf, data APBDes belum tersedia.'
            ]);
        }

        $tahunDipilih = $request->input('tahun') ?? $daftarTahun[0];

        $apbdes = Apbdes::where('tahun', $tahunDipilih)->get();

        return view('apbdes.apbdes-view', compact('daftarTahun', 'apbdes', 'tahunDipilih'));
    }

    public function tampilUntukUser()
    {
        $title = 'Lihat APBDes';
        $halaman = 'APBDes';
        $apbdes = Apbdes::whereNull('deleted_at')->orderBy('created_at', 'desc')->get();

        return view('apbdes.apbdes-view', compact('title', 'halaman', 'apbdes'));
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
        $request->validate([
            'pendapatan' => 'required|string',
            'penyelenggaraan' => 'required|string',
            'pelaksanaan' => 'required|string',
            'pembinaan' => 'required|string',
            'pemberdayaan' => 'required|string',
            'penanggulangan' => 'required|string',
            'pejabat' => 'required|string',
            'tahun' => 'required|integer',
            'file' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
        ], [
            'file.max' => 'Size file yang anda pilih terlalu besar!',
            'file.mimes' => 'Format file yang anda masukan tidak sesuai!',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            // Buat nama file unik
            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = uniqid('apbdes_') . '.' . $extension;

            // Simpan file dengan nama baru
            $filePath = $request->file('file')->storeAs('apbdes', $filename, 'public');
        }

        try {
            Apbdes::create([
                'pendapatan' => $request->pendapatan,
                'penyelenggaraan' => $request->penyelenggaraan,
                'pelaksanaan' => $request->pelaksanaan,
                'pembinaan' => $request->pembinaan,
                'pemberdayaan' => $request->pemberdayaan,
                'penanggulangan' => $request->penanggulangan,
                'pejabat' => $request->pejabat,
                'tahun' => $request->tahun,
                'file' => $filePath, // simpan path file
            ]);

            return redirect()->route('apbdes.index')->with('success', "Data APBDes baru Berhasil di Tambahkan");
        } catch (Exception $e) {
            Log::error('Gagal menyimpan data APBDes: ' . $e->getMessage());
            return back()->withErrors(['create_error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Apbdes $apbdes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apbdes $apbdes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $apbdes = Apbdes::findOrFail($id);
        Log::info("ID yang diterima untuk update: ", ['id' => $apbdes->id]);

        $request->validate([
            'pendapatan' => 'required|string',
            'penyelenggaraan' => 'required|string',
            'pelaksanaan' => 'required|string',
            'pembinaan' => 'required|string',
            'pemberdayaan' => 'required|string',
            'penanggulangan' => 'required|string',
            'pejabat' => 'required|string',
            'tahun' => 'required|integer',
            'file' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
        ], [
            'file.max' => 'Size file yang anda pilih terlalu besar!',
            'file.mimes' => 'Format file yang anda masukan tidak sesuai!',
        ]);

        try {
            if ($request->hasFile('file')) {
                // Hapus file lama kalau ada
                if ($apbdes->file && Storage::exists('public/' . $apbdes->file)) {
                    Storage::delete('public/' . $apbdes->file);
                    Log::info('File lama berhasil dihapus: ' . $apbdes->file);
                }

                // Buat nama file baru unik
                $extension = $request->file('file')->getClientOriginalExtension();
                $filename = uniqid('apbdes_') . '.' . $extension;

                // Upload file baru dengan nama unik
                $filePath = $request->file('file')->storeAs('apbdes', $filename, 'public');
                Log::info('File baru berhasil diupload: ' . $filePath);
            } else {
                $filePath = $apbdes->file;
            }

            // Update data
            $apbdes->update([
                'pendapatan' => $request->pendapatan,
                'penyelenggaraan' => $request->penyelenggaraan,
                'pelaksanaan' => $request->pelaksanaan,
                'pembinaan' => $request->pembinaan,
                'pemberdayaan' => $request->pemberdayaan,
                'penanggulangan' => $request->penanggulangan,
                'pejabat' => $request->pejabat,
                'tahun' => $request->tahun,
                'file' => $filePath,
            ]);

            return redirect()->route('apbdes.index')->with('success', 'Data APBDes berhasil diubah');
        } catch (Exception $e) {
            Log::error('Gagal update APBDes: ' . $e->getMessage());
            return back()->withErrors(['update_error' => 'Terjadi kesalahan saat memperbarui data.']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $apbdes = Apbdes::findOrFail($id);

        Log::info("Masuk ke destroy dengan ID:", ['id' => $apbdes->id]);

        if ($apbdes->file) {
            Storage::delete('public/' . $apbdes->file);
        }

        $apbdes->delete();

        return redirect()->route('apbdes.index')->with('success', 'Data APBDes berhasil dihapus');
    }
}
