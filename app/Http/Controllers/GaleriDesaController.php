<?php

namespace App\Http\Controllers;

use App\Models\GaleriDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GaleriDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $title = 'Halaman Galeri Desa';
        $halaman = 'Galeri Desa';
        $user = $request->user();
        $galeri = DB::table('galeri_desas')->get();

        return view('galeri.index', compact('title', 'halaman', 'user', 'galeri'));
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
        // Validasi input
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // dd($request->all());

        // Simpan gambar dengan nama berbasis timestamp
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $timestamp = now()->format('YmdHis'); // Format timestamp (YYYYMMDDHHMMSS)
            $filename = $timestamp . '_' . uniqid() . '.' . $image->getClientOriginalExtension(); // Nama unik
            $imagePath = $image->storeAs('galeri', $filename, 'public'); // Simpan di storage
        }

        // Simpan data ke database
        GaleriDesa::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'image' => $imagePath
        ]);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil ditambahkan');
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
            'image' => $imagePath
        ]);

        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $galeri = GaleriDesa::findOrFail($id);
        $galeri->delete();
        return redirect()->route('galeri.index')->with('success', 'Galeri berhasil dihapus');
    }
}
