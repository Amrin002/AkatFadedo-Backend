<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiKeluhanController extends Controller
{
    // Tampilkan semua keluhan
    public function index()
    {
        $keluhan = Keluhan::with('user')->latest()->get();
        return response()->json($keluhan);
    }

    // Tambah keluhan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $keluhan = Keluhan::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'user_id' => Auth::id() ?? 1, // default 1 kalau belum pakai auth API
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Keluhan berhasil dibuat',
            'data' => $keluhan
        ], 201);
    }

    // Tampilkan detail 1 keluhan
    public function show(Keluhan $keluhan)
    {
        return response()->json($keluhan);
    }

    // Update keluhan
    public function update(Request $request, Keluhan $keluhan)
    {
        $request->validate([
            'judul' => 'sometimes|string|max:255',
            'isi' => 'sometimes|string',
            'status' => 'in:pending,diproses,selesai',
        ]);

        $keluhan->update($request->only('judul', 'isi', 'status'));

        return response()->json([
            'message' => 'Keluhan berhasil diperbarui',
            'data' => $keluhan
        ]);
    }

    // Hapus keluhan
    public function destroy(Keluhan $keluhan)
    {
        $keluhan->delete();

        return response()->json([
            'message' => 'Keluhan berhasil dihapus'
        ]);
    }
}
