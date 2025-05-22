@extends('layouts.landing') {{-- atau sesuaikan layoutmu --}}

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div style="text-align: center; padding: 100px;">
    <img src="{{ asset('images/notfound.png') }}" alt="404 Not Found" style="max-width: 350px;">
    <h3>Oops! Halaman tidak ditemukan.</h3>
    <p>Sepertinya halaman yang kamu cari tidak tersedia.</p>
    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
</div>
@endsection
