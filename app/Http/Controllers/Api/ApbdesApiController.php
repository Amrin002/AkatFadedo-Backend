<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apbdes;


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
}
