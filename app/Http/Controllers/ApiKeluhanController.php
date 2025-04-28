<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ApiKeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keluhan = Keluhan::with('user')->latest()->get();
        return response()->json($keluhan);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Keluhan $keluhan)
    {
        return response()->json($keluhan);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keluhan $keluhan)
    {
        $keluhan->delete();

        return response()->json([
            'message' => 'Keluhan berhasil dihapus'
        ]);
    }
}
