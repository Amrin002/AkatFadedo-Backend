<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function index(Request $request)
{
    $title = 'Daftar keluhan';
    $status = $request->get('status');
    $query = Keluhan::with('user')->latest();

    if ($status) {
        $query->where('status', $status);
    }
    $user = $request->user();

    $keluhan = $query->get();
    // return view('keluhan.index', [
    //     'keluhan' => $keluhan,
    //     'status' => $status,
    //     'title' => 'Daftar Keluhan'
    // ]);
    return view('keluhan.index', compact('keluhan', 'status', 'query', 'user', 'title'));
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
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

     $path = null;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('keluhan', 'public');
        }

    $keluhan = Keluhan::create([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'user_id' => Auth::id(),
        'gambar' => $path,

    ]);

    // Kirim notifikasi ke semua admin
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::createNotification(
                $admin->id,
                'keluhan',
                "Pengajuan Keluhan oleh {$keluhan->user->name}",
                $keluhan->id,
                Keluhan::class,
                [
                    'judul' => $keluhan->judul,
                ]
            );
        }

    return redirect()->route('keluhan.index')->with('success', 'Keluhan berhasil dikirim!');
}

public function show(Keluhan $keluhan)
{
    return view('keluhan.show', [
        'keluhan' => $keluhan,
        'title' => 'Detail Keluhan'
    ]);

}


public function update(Request $request, $id)
{
    $keluhan = Keluhan::findOrFail($id);

    // Validasi
    $request->validate([
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Cek hak akses
    if (Auth::id() !== $keluhan->user_id && Auth::user()->role !== 'admin') {
        abort(403, 'Unauthorized');
    }

    // Ganti gambar jika ada
    if ($request->hasFile('gambar')) {
        if ($keluhan->gambar && Storage::disk('public')->exists($keluhan->gambar)) {
            Storage::disk('public')->delete($keluhan->gambar);
        }
        $keluhan->gambar = $request->file('gambar')->store('keluhan', 'public');
    }

    $keluhan->judul = $request->judul;
    $keluhan->isi = $request->isi;
    $keluhan->save();

    return redirect()->route('keluhan.index')->with('success', 'Keluhan berhasil diperbarui.');
}




public function tanggapi(Request $request, Keluhan $keluhan)
{
    $request->validate([
        'respon_admin' => 'required|string',
    ]);

    $keluhan->update([
        'status' => 'diproses',
        'respon_admin' => $request->respon_admin,
        'tanggal_diproses' => now(),
    ]);

    return redirect()->back()->with('success', 'Keluhan ditandai sebagai diproses dengan tanggapan.');
}


public function selesaikan(Keluhan $keluhan)
{
    $keluhan->update([
        'status' => 'selesai',
        'tanggal_selesai' => now(),
    ]);

    return redirect()->back()->with('success', 'Keluhan telah diselesaikan.');
}


public function destroy(string $id)
{
    $keluhan = keluhan::findOrFail($id);

     if ($keluhan->gambar && Storage::disk('public')->exists($keluhan->gambar)) {
            Storage::disk('public')->delete($keluhan->gambar);
        }

    $keluhan -> delete();
    return redirect()->route('keluhan.index')->with('succes', 'Keluhan berhasil dihapus!');
}


}
