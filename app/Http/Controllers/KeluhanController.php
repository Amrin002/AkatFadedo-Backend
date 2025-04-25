<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function index(Request $request)
{
    $status = $request->get('status');
    $query = Keluhan::with('user')->latest();

    if ($status) {
        $query->where('status', $status);
    }

    $keluhan = $query->get();
    return view('keluhan.index', [
        'keluhan' => $keluhan,
        'status' => $status,
        'title' => 'Daftar Keluhan'
    ]);
}

public function create()
{
    return view('keluhan.create');
}

public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
    ]);

    Keluhan::create([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'user_id' => Auth::id(), 

    ]);

    return redirect()->route('keluhan.index')->with('success', 'Keluhan berhasil dikirim!');
}

public function show(Keluhan $keluhan)
{
    return view('keluhan.show', [
        'keluhan' => $keluhan,
        'title' => 'Detail Keluhan'
    ]);
    
}

public function tanggapi(Keluhan $keluhan)
{
    $keluhan->update(['status' => 'diproses']);
    return redirect()->back()->with('success', 'Keluhan telah ditandai sebagai diproses.');
}

public function destroy(string $id)
{
    $keluhan = keluhan::findOrFail($id);
    $keluhan -> delete();
    return redirect()->route('keluhan.index')->with('succes', 'Keluhan berhasil dihapus!');
}


}
