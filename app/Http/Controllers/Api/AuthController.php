<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'nik' => 'required|string|unique:users|max:20',
                'no_telp' => 'nullable|string|unique:users|max:15',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:8',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            $penduduk = Penduduk::where('nik', $request->nik)->first();
            // Tambahkan pengecekan eksplisit
            if (!$penduduk) {
                return response()->json([
                    'message' => 'NIK tidak ditemukan dalam data penduduk'
                ], 422);
            }

            if (
                User::where('nik', $request->nik)->exists() ||
                User::where('email', $request->email)->exists() ||
                ($request->no_telp && User::where('no_telp', $request->no_telp)->exists())
            ) {
                $errors = [];

                if (User::where('nik', $request->nik)->exists()) {
                    $errors['nik'] = ['NIK sudah digunakan'];
                }

                if (User::where('email', $request->email)->exists()) {
                    $errors['email'] = ['Email sudah digunakan'];
                }

                if ($request->no_telp && User::where('no_telp', $request->no_telp)->exists()) {
                    $errors['no_telp'] = ['Nomor telepon sudah digunakan'];
                }

                return response()->json([
                    'message' => 'Data sudah terdaftar',
                    'errors' => $errors
                ], 409);
            }

            // Simpan foto jika ada
            $photoPath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = now()->format('YmdHis') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $photoPath = $image->storeAs('profile_photos', $filename, 'public');
            }

            $user = User::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'penduduk_id' => optional($penduduk)->id,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role ?? 'user',
                'image' => $photoPath,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'User berhasil register',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ], 201); // Gunakan status 201 Created
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422); // Status 422 untuk validasi gagal
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500); // Status 500 untuk kesalahan server
        }
    }
    public function update(Request $request, $id)
    {
        $user = $request->user(); // Ambil user yang sedang login
        $user = User::find($id); // Ambil user berdasarkan ID
        $request->validate([
            'name' => 'nullable|string',
            'no_telp' => 'nullable|string|unique:users,no_telp,' . $user->id,
            'email' => 'nullable|string|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan foto baru jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = now()->format('YmdHis') . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $photoPath = $image->storeAs('profile_photos', $filename, 'public');

            // Hapus foto lama jika ada
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
            $user->image = $photoPath;
        }

        // Update data user
        if ($request->filled('name')) {
            $user->name = $request->name;
        }
        if ($request->filled('no_telp')) {
            $user->no_telp = $request->no_telp;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        //debug
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        try {
            $user->save();

            return response()->json([
                'message' => 'Profile updated successfully',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error('Update Failed', [
                'error' => $e->getMessage(),
                'user_data' => $user->toArray()
            ]);

            return response()->json([
                'message' => 'Update failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('nik', $request->nik)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
                'errors' => [
                    'nik' => ['Invalid credentials']
                ]
            ], 401); // Gunakan 401 untuk error login
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }

    public function index(Request $request)
    {
        if ($request->has('id')) {
            $user = User::find($request->id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json($user);
        }

        return response()->json(User::all());
    }
}
