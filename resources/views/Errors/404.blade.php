@extends('layouts.main')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <main>
        <div class="text-center d-flex flex-column justify-content-center align-items-center"
            style="min-height: calc(100vh - 100px);">
            <!-- 100px kira-kira tinggi header + footer -->

            <img src="{{ asset('images/notfound.png') }}"
                alt="404 Not Found"
                style="max-width: 350px; width: 100%; height: auto;">

            <h3 class="mt-4">Oops! Halaman tidak ditemukan.</h3>
            <p>Sepertinya halaman yang kamu cari tidak tersedia.</p>

            <a href="{{ url('/') }}" class="px-4 mt-3 btn btn-outline-primary rounded-pill">
                Kembali ke Beranda
            </a>
        </div>
    </main>
@endsection
