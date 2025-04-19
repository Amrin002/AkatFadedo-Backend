<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
{
    $berita = Berita::latest()->get();
    return view('berita.index', [
        'berita' => $berita,
        'title' => 'Daftar Berita' // Kirim variabel $title ke view
    ]);
}

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'konten' => 'required',
        'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        'tanggal_berita' => now(),

    ]);

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('berita', 'public');
    }
    
    Berita::create([
        'judul' => $request->judul,
        'konten' => $request->konten,
        'gambar' => $gambarPath,
        'user_id' => Auth::id(), 
    ]);

    return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan!');
}


    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            Storage::delete($berita->gambar);
            $berita->gambar = $request->file('gambar')->store('berita');
        }

        $berita->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        // if ($berita->gambar) {
        //     Storage::delete($berita->gambar);
        // }
        
        $berita = Berita::findOrFail($id);

         if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();
        
        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
