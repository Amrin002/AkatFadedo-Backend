<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    public function wagw(Request $request)
    {
        // Periksa apakah pengguna sudah terautentikasi
        if ($user = $request->user()) {
            $title = 'WaGw';
            return view('admin.wagw', compact('title', 'user'));
        }

        // Jika tidak terautentikasi, bisa redirect atau tampilkan error
        return redirect()->route('login')->with('error', 'Please log in to access this page.');
    }

    public function send()
    {
        return;
    }
}
