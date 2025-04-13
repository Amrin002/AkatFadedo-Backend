<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'nik' => 'required|string|unique:users|max:20',
            'no_telp' => 'nullable|string|unique:users|max:15',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
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
        ]);
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
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('nik', $request->nik)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'nik' => ['Invalid credentials'],
            ]);
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
    // public function show($id)
    // {
    //     $user = User::find($id);

    //     if (!$user) {
    //         return response()->json(['message' => 'User not found'], 404);
    //     }

    //     return response()->json($user);
    // }

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
