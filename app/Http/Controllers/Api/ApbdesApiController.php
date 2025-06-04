<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apbdes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class ApbdesApiController extends Controller
{
    public function index()
    {
        $apbdes = Apbdes::whereNull('deleted_at')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data APBDes berhasil diambil',
            'data' => $apbdes
        ]);
    }

    public function show($id)
    {
        $apbdes = Apbdes::find($id);

        if (!$apbdes) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Detail data ditemukan',
            'data' => $apbdes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pendapatan' => 'required|string',
            'penyelenggaraan' => 'required|string',
            'pelaksanaan' => 'required|string',
            'pembinaan' => 'required|string',
            'pemberdayaan' => 'required|string',
            'penanggulangan' => 'required|string',
            'tahun' => 'required|integer',
            'file' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        try {
            $filePath = $request->file('file')->storeAs(
                'apbdes',
                $request->file('file')->getClientOriginalName(),
                'public'
            );

            $apbdes = Apbdes::create([
                'pendapatan' => $request->pendapatan,
                'penyelenggaraan' => $request->penyelenggaraan,
                'pelaksanaan' => $request->pelaksanaan,
                'pembinaan' => $request->pembinaan,
                'pemberdayaan' => $request->pemberdayaan,
                'penanggulangan' => $request->penanggulangan,
                'tahun' => $request->tahun,
                'file' => $filePath,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $apbdes
            ]);
        } catch (Exception $e) {
            Log::error('Gagal menambah APBDes: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Gagal menambah data'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $apbdes = Apbdes::find($id);

        if (!$apbdes) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'pendapatan' => 'required|string',
            'penyelenggaraan' => 'required|string',
            'pelaksanaan' => 'required|string',
            'pembinaan' => 'required|string',
            'pemberdayaan' => 'required|string',
            'penanggulangan' => 'required|string',
            'tahun' => 'required|integer',
            'file' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        try {
            $filePath = $apbdes->file;

            if ($request->hasFile('file')) {
                if ($filePath && Storage::exists('public/' . $filePath)) {
                    Storage::delete('public/' . $filePath);
                }

                $filePath = $request->file('file')->storeAs(
                    'apbdes',
                    $request->file('file')->getClientOriginalName(),
                    'public'
                );
            }

            $apbdes->update([
                'pendapatan' => $request->pendapatan,
                'penyelenggaraan' => $request->penyelenggaraan,
                'pelaksanaan' => $request->pelaksanaan,
                'pembinaan' => $request->pembinaan,
                'pemberdayaan' => $request->pemberdayaan,
                'penanggulangan' => $request->penanggulangan,
                'tahun' => $request->tahun,
                'file' => $filePath,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperbarui',
                'data' => $apbdes
            ]);
        } catch (Exception $e) {
            Log::error('Gagal update APBDes: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Gagal memperbarui data'], 500);
        }
    }

    public function destroy($id)
    {
        $apbdes = Apbdes::find($id);

        if (!$apbdes) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        if ($apbdes->file && Storage::exists('public/' . $apbdes->file)) {
            Storage::delete('public/' . $apbdes->file);
        }

        $apbdes->delete();

        return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
    }
}
