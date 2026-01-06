<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use App\Models\GaleriDesa;
use App\Models\KegiatanDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GaleriDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Halaman Galeri Desa';
        $halaman = 'Galeri Desa';
        $user = $request->user();

        // Gunakan Eloquent dengan relasi
        $galeri = GaleriDesa::with('kegiatan')
        ->orderBy('created_at', 'desc') // 🔥 FOTO TERBARU DI ATAS
        ->get();

        // Ambil semua kegiatan untuk dropdown
        $kegiatanList = KegiatanDesa::orderBy('judul')->get();

        return view('galeri.index', compact('title', 'halaman', 'user', 'galeri', 'kegiatanList'));
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
        'nama_kegiatan' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'kegiatan_option' => 'required|in:existing,new',
    ]);

    DB::beginTransaction();
    try {
        $kegiatanDesaId = null;

        if ($request->kegiatan_option === 'existing') {

            // =========================
            // PILIH KEGIATAN EXISTING
            // =========================
            $request->validate([
                'kegiatan_desa_id' => 'required|exists:kegiatan_desas,id',
            ]);

            $kegiatanDesaId = $request->kegiatan_desa_id;

        } else {

            // =========================
            // BUAT / AMBIL KEGIATAN BARU
            // =========================
            $request->validate([
                'judul_kegiatan_baru' => 'required|string|max:255',
                'deskripsi_kegiatan_baru' => 'nullable|string',
                'tanggal_kegiatan_baru' => 'nullable|date',
            ]);

            // 🔴 CEK APAKAH JUDUL SUDAH ADA
            $existingKegiatan = KegiatanDesa::whereRaw(
                'LOWER(judul) = ?',
                [Str::lower($request->judul_kegiatan_baru)]
            )->first();

            if ($existingKegiatan) {
                // ✅ SUDAH ADA → PAKAI YANG LAMA
                $kegiatanDesaId = $existingKegiatan->id;
            } else {
                // ✅ BELUM ADA → BUAT BARU
                $kegiatanBaru = KegiatanDesa::create([
                    'judul' => $request->judul_kegiatan_baru,
                    'deskripsi' => $request->deskripsi_kegiatan_baru,
                    'tanggal' => $request->tanggal_kegiatan_baru,
                ]);

                $kegiatanDesaId = $kegiatanBaru->id;
            }
        }

        // =========================
        // SIMPAN GAMBAR
        // =========================
        $imagePath = $request->file('image')
            ->store('galeri', 'public');

        // =========================
        // SIMPAN GALERI
        // =========================
        GaleriDesa::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'image' => $imagePath,
            'kegiatan_desa_id' => $kegiatanDesaId,
        ]);

        DB::commit();
        return redirect()->route('galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

public function byKegiatan($id)
{
    $galeri = GaleriDesa::with('kegiatan')
        ->where('kegiatan_desa_id', $id)
        ->orderBy('created_at', 'desc') // FOTO TERBARU DI ATAS
        ->paginate(12);

    return view('galeri.semua', compact('galeri'));
}

    /**
     * Display the specified resource.
     */
    public function show(GaleriDesa $galeriDesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GaleriDesa $galeriDesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kegiatan_desa_id' => 'required|exists:kegiatan_desas,id',
        ]);

        $galeri = GaleriDesa::findOrFail($id);

        // Jika ada file baru, simpan dengan nama timestamp
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $timestamp = now()->format('YmdHis');
            $filename = $timestamp . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('galeri', $filename, 'public');

            // Hapus gambar lama jika ada
            if ($galeri->image) {
                Storage::disk('public')->delete($galeri->image);
            }
        } else {
            $imagePath = $galeri->image;
        }

        // Update data
        $galeri->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'image' => $imagePath,
            'kegiatan_desa_id' => $request->kegiatan_desa_id,
        ]);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $galeri = GaleriDesa::findOrFail($id);

        // Hapus gambar dari storage
        if ($galeri->image) {
            Storage::disk('public')->delete($galeri->image);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus');
    }
}
