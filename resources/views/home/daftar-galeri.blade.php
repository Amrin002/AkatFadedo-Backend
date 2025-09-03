@extends('layouts.landing')

@section('content')
    <main class="container py-5">
        <h2 class="mb-4 text-center fw-bold">Galeri Desa Akat Fadedo</h2>
        <div class="row">
            <div class="text-left my-4">
                <a href="{{ route('home') }}" class="lihat-berita-link">
                    <i class="fas fa-home me-1"></i>Home
                </a>
            </div>
            @forelse ($galeri as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">

                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top"
                            alt="{{ $item->nama_kegiatan }}" style="height: 300px; object-fit: cover;">

                        <div class="card-footer bg-white border-0 text-center">
                            <h3>{{ $item->nama_kegiatan }}</h3>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada berita tersedia.</div>
                </div>
            @endforelse
        </div>
    </main>
@endsection
