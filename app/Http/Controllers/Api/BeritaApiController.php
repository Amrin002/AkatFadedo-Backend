<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaApiController extends Controller
{
    // Ambil semua berita
    public function index()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->get();
        return response()->json($beritas);
    }

    // Tambah berita
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('berita', 'public');
        }

        $berita = Berita::create([
            'judul' => $request->judul,
            'konten' => $request->konten,
            'gambar' => $path,
            'user_id' => $request->user_id ?? 1 // fallback ke 1 jika tidak dikirim
        ]);

        return response()->json([
            'message' => 'Berita berhasil ditambahkan.',
            'data' => $berita
        ], 201);
    }

    // Detail berita
    public function show($id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($berita);
    }

    // // Update berita
    // public function update(Request $request, $id)
    // {
    //     $berita = Berita::findOrFail($id);

    //     $request->validate([
    //         'judul' => 'sometimes|string|max:255',
    //         'konten' => 'sometimes|string',
    //         'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     if ($request->hasFile('gambar')) {
    //         if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
    //             Storage::disk('public')->delete($berita->gambar);
    //         }
    //         $berita->gambar = $request->file('gambar')->store('berita', 'public');
    //     }

    //     $berita->update($request->only('judul', 'konten'));

    //     return response()->json(['message' => 'Berita berhasil diupdate', 'data' => $berita]);
    // }

    // Hapus berita
    // public function destroy($id)
    // {
    //     $berita = Berita::findOrFail($id);

    //     if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
    //         Storage::disk('public')->delete($berita->gambar);
    //     }

    //     $berita->delete();

    //     return response()->json(['message' => 'Berita berhasil dihapus.']);
    // }
}
