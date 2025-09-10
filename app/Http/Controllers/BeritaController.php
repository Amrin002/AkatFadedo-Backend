<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita; // ✅ import model kategori
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index(Request $request)
{
    $user  = $request->user();
    $title = 'Daftar Berita';

    // Ambil kategori dari config
    $kategori = collect(config('kategori'));

    // Query berita
    $query = Berita::latest();

    // Jika ada filter kategori
    if ($request->filled('kategori')) {
        $query->where('kategori', $request->kategori);
    }

    $berita = $query->get();

    return view('berita.index', compact('user', 'berita', 'kategori', 'title'));
}

public function create()
{
    $title    = 'Tambah Berita';
    $kategori = collect(config('kategori'));
    return view('berita.create', compact('title', 'kategori'));
}

public function store(Request $request)
{
    $request->validate([
        'judul'    => 'required|string|max:255',
        'konten'   => 'required',
        'kategori' => 'required|string',
        'gambar'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('berita', 'public');
    }

    Berita::create([
        'judul'    => $request->judul,
        'konten'   => $request->konten,
        'gambar'   => $gambarPath,
        'user_id'  => Auth::id(),
        'kategori' => $request->kategori, // simpan nama kategori langsung
    ]);

    return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
}

public function edit($id)
{
    $berita   = Berita::findOrFail($id);
    $title    = 'Edit Berita';
    $kategori = collect(config('kategori'));
    return view('berita.edit', compact('berita', 'title', 'kategori'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'judul'    => 'required|string|max:255',
        'konten'   => 'required',
        'kategori' => 'required|string',
        'gambar'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $berita = Berita::findOrFail($id);

    $data = [
        'judul'    => $request->judul,
        'konten'   => $request->konten,
        'kategori' => $request->kategori,
    ];

    if ($request->hasFile('gambar')) {
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $data['gambar'] = $request->file('gambar')->store('berita', 'public');
    }

    $berita->update($data);

    return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
}


    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
