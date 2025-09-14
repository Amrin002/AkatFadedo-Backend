@extends('layouts.main')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
    <div style="text-align: center; padding: 100px; height:auto">
        <img src="{{ asset('images/notfound.png') }}" alt="404 Not Found" style="max-width: 350px; width: 100%; height: auto;">
        <h3>Oops! Halaman tidak ditemukan.</h3>
        <p>Sepertinya halaman yang kamu cari tidak tersedia.</p>
        <a href="{{ url('/') }}" class="px-4 btn btn-outline-primary rounded-pill">Kembali ke Beranda</a>
    </div>
@endsection
