<?php

namespace App\Http\Controllers;

use App\Models\KegiatanDesa;
use App\Models\GaleriDesa;
use Illuminate\Http\Request;

class KegiatanDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Halaman Kegiatan Desa';
        $halaman = 'Kegiatan Desa';
        $user = $request->user();

        $kegiatan = KegiatanDesa::withCount('fotos')
            ->latest()
            ->get();

        return view('kegiatan.index', compact(
            'title',
            'halaman',
            'user',
            'kegiatan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kegiatan Desa';
        $halaman = 'Tambah Kegiatan';

        return view('kegiatan.create', compact('title', 'halaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        KegiatanDesa::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     * DETAIL KEGIATAN + GRID FOTO
     */
    public function show($id)
    {
        $kegiatan = KegiatanDesa::with(['fotos' => function ($query) {
            $query->orderBy('tanggal', 'desc')
                ->orderBy('created_at', 'desc');
        }])
            ->findOrFail($id);

        $title = $kegiatan->judul;
        $halaman = 'Detail Kegiatan';

        return view('kegiatan.show', compact(
            'title',
            'halaman',
            'kegiatan'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kegiatan = KegiatanDesa::findOrFail($id);
        $title = 'Edit Kegiatan Desa';
        $halaman = 'Edit Kegiatan';

        return view('kegiatan.edit', compact(
            'title',
            'halaman',
            'kegiatan'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $kegiatan = KegiatanDesa::findOrFail($id);

        $kegiatan->update([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kegiatan = KegiatanDesa::findOrFail($id);

        // Cek apakah ada foto terkait
        $jumlahFoto = $kegiatan->fotos()->count();

        if ($jumlahFoto > 0) {
            return redirect()
                ->route('kegiatan.index')
                ->with('error', "Tidak dapat menghapus kegiatan. Masih ada {$jumlahFoto} foto terkait.");
        }

        $kegiatan->delete();

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus');
    }
}
