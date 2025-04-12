<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        //
        $title = 'Halaman Pengguna';
        $halaman = 'Pengguna';
        $user = $request->user();

        // Mengambil semua pengguna tanpa filter devisi atau staf
        $users = DB::table('users')
            ->where('role', 'user') // Hanya ambil pengguna dengan role "user"
            ->orderByDesc('id')
            ->get();
        return view('pengguna.index', compact('title', 'halaman', 'users', 'user'));
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
        //
        // Validasi data input
        $request->validate([
            'nik' => 'required|string|max:16|unique:users,nik',
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // dd($request->nik, Penduduk::where('nik', $request->nik)->first());

        $penduduk = Penduduk::where('nik', $request->nik)->first();
        if (!$penduduk) {
            return back()->withErrors(['nik' => 'NIK tidak terdaftar di data penduduk.'])->withInput();
        }

        // Simpan foto jika ada
        // Simpan foto jika ada
        $photoPath = null; // Default null jika tidak ada foto
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $timestamp = now()->format('YmdHis'); // Format timestamp (YYYYMMDDHHMMSS)
            $filename = $timestamp . '_' . uniqid() . '.' . $image->getClientOriginalExtension(); // Nama unik
            $photoPath = $image->storeAs('profile_photos', $filename, 'public'); // Simpan di storage
        }

        // Debugging: Cek apakah file terupload dan tampilkan semua request
        // dd([
        //     'all_request' => $request->all(),
        //     'photo_path' => $photoPath,
        // ]);

        // Simpan data ke database
        User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password sebelum disimpan
            'role' => $request->role,
            'image' => $photoPath,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::findOrFail($id);
        return view('pengguna.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nik' => 'required|string|max:16',
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6', // Password opsional
            'role' => 'required|in:admin,user',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Update foto jika ada yang diunggah
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $image = $request->file('image');
            $filename = now()->format('YmdHis') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $photoPath = $image->storeAs('profile_photos', $filename, 'public');
        } else {
            $photoPath = $user->image;
        }
        // Update data pengguna
        $user->update([
            'nik' => $request->nik,
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'role' => $request->role,
            'image' => $photoPath,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Hanya update jika diisi
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
        // Hapus foto profil jika ada dan bukan foto default
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // Hapus pengguna
        $user->delete();

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
