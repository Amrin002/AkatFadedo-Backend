@extends('layouts.landing')

@section('content')
<main class="container mt-5 mb-5">
    <div class="row">
        {{-- KONTEN UTAMA --}}
        <div class="col-lg-8">
            <div class="text-left my-4">
                <a href="{{ route('home.daftar-berita') }}" class="lihat-berita-link">
                    <i class="fas fa-newspaper me-1"></i>Berita Desa Akat Fadedo
                </a>
            </div>
            <h2 class="fw-bold mb-2">{{ $berita->judul }}</h2>

            <div class="d-flex align-items-center text-muted mb-3" style="font-size: 0.9rem;">
                <i class="far fa-calendar-alt me-1"></i> {{ $berita->created_at->format('d F Y') }}
                <span class="mx-2">|</span>
                <i class="fas fa-user me-1"></i> {{ $berita->user->name ?? 'Administrator' }}
                <span class="mx-2">|</span>
                <i class="fas fa-eye me-1"></i> Dilihat {{ $berita->views ?? 0 }} kali
            </div>

            <img src="{{ asset('storage/' . $berita->gambar) }}"
                 class="img-fluid rounded mb-4"
                 style="max-height: 500px; object-fit: cover; width: 100%;"
                 alt="{{ $berita->judul }}">

            <div style="line-height: 1.8; font-size: 1.05rem;">
                {!! $berita->konten !!}
            </div>
        </div>

        {{-- SIDEBAR (Berita Terbaru) --}}
        <div class="col-lg-4">
            <h5 class="fw-semibold mb-3">Berita Terbaru</h5>
            @foreach($berita_terbaru as $item)
            <a href="{{ route('home.berita', $item->slug) }}" class="text-dark text-decoration-none">
                <div class="d-flex mb-3">
                    <img src="{{ asset('storage/' . $item->gambar) }}"
                         alt=""
                         class="me-2"
                         style="width: 100px; height: 80px; object-fit: cover; border-radius: 5px;">
                    <div>
                        
                        <p class="mb-1">
                            <strong class="fs-6">{{ \Illuminate\Support\Str::limit($item->judul, 45) }}</strong>
                        
                        
                        </a>
                        <br>
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i> {{ $berita->created_at->format('d F Y') }}
                            <i class="fas fa-eye me-1"></i> Dilihat {{ $berita->views ?? 0 }} kali
                        </small>
                    </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection
