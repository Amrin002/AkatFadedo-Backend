<?php

namespace App\Http\Controllers;

use App\Models\StrukturDesa;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StrukturDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $title = 'Halaman Struktur Desa';
        $halaman = 'Struktur Desa';
        $user = $request->user();
        $struktur = DB::table('struktur_desas')->get();
        return view('strukturdesa.index', compact('title', 'halaman', 'user', 'struktur'));
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
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'twitter' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);
        // Simpan gambar jika ada
        $imagePath = null; // Default null jika tidak ada gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $timestamp = now()->format('YmdHis'); // Format timestamp (YYYYMMDDHHMMSS)
            $filename = $timestamp . '_' . uniqid() . '.' . $image->getClientOriginalExtension(); // Nama unik
            $imagePath = $image->storeAs('struktur_desa', $filename, 'public'); // Simpan di storage

        }
        // dd([
        //     'all_request' => $request->all(),
        //     'photo_path' => $imagePath,
        // ]);


        // Simpan data ke database
        StrukturDesa::create([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'image' => $imagePath,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ]);

        return redirect()->route('struktur.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StrukturDesa $strukturDesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StrukturDesa $strukturDesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'nama' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'twitter' => 'nullable|url',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);
        $struktur = StrukturDesa::findOrFail($id);
        // Simpan gambar baru jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('struktur_desa', 'public');
        } else {
            $imagePath = $struktur->image;
        }


        $struktur->update([
            'nama' => $request->nama,
            'posisi' => $request->posisi,
            'image' => $imagePath,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ]);

        return redirect()->route('struktur.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $struktur = StrukturDesa::findOrFail($id);
        $struktur->delete();

        return redirect()->route('struktur.index')->with('success', 'Data berhasil dihapus');
    }
}
