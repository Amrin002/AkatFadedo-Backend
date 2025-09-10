@extends('layouts.landing')

@section('content')
    <main class="container mt-5 mb-5">
        <div class="row">
            {{-- KONTEN UTAMA --}}
            <div class="col-lg-8">
                <div class="text-left my-4">
                    <a href="{{ route('home.daftar-berita') }}" class="lihat-berita-link">
                        <i class="fas fa-newspaper me-1"></i> Berita Desa Akat Fadedo
                    </a>
                </div>

                <h2 class="fw-bolder text-dark mb-2" style="color:#000; font-weight:900;">
                    {{ $berita->judul }}
                </h2>
                

                <div class="d-flex align-items-center text-muted mb-3" style="font-size: 0.9rem;">
                    <i class="far fa-calendar-alt me-1"></i> {{ $berita->created_at->format('d F Y') }}
                    <span class="mx-2">|</span>
                    <i class="fas fa-user me-1"></i> {{ $berita->user->name ?? 'Administrator' }}
                    <span class="mx-2">|</span>
                    <i class="fas fa-eye me-1"></i> Dilihat {{ $berita->views ?? 0 }} kali
                </div>

                {{-- Gambar Utama --}}
                <img src="{{ asset('storage/' . $berita->gambar) }}" 
                     class="img-fluid rounded mb-2"
                     style="max-height: 500px; object-fit: cover; width: 100%;" 
                     alt="{{ $berita->judul }}">

                {{-- Badge Kategori --}}
                @if (isset($kategoriData[$kategoriKey]))
                    <div class="mb-3">
                        <span class="badge bg-primary">
                            <i class="{{ $kategoriData[$kategoriKey]['icon'] }} me-1"></i>
                            {{ $kategoriData[$kategoriKey]['nama'] }}
                        </span>
                    </div>
                @endif

                {{-- Konten Berita --}}
                <div style="line-height: 1.8; font-size: 1.05rem;">
                    {!! $berita->konten !!}
                </div>
            </div>

            {{-- SIDEBAR (Berita Terbaru) --}}
            <div class="col-lg-4">
                <h5 class="fw-semibold mb-3">Berita Terbaru</h5>
                @foreach ($berita_terbaru as $item)
                    @php
                        $katKey = strtolower(trim($item->kategori));
                    @endphp
                    <a href="{{ route('home.berita', $item->slug) }}" class="text-dark text-decoration-none">
                        <div class="d-flex mb-3">
                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                 alt="" 
                                 class="me-2"
                                 style="width: 100px; height: 80px; object-fit: cover; border-radius: 5px;">
                            <div>
                                <p class="mb-1 fw-semibold">
                                    {{ \Illuminate\Support\Str::limit($item->judul, 45) }}
                                </p>

                                <small class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $item->created_at->format('d F Y') }}
                                    <i class="fas fa-eye ms-2 me-1"></i> {{ $item->views ?? 0 }}
                                </small>

                                {{-- Tambahkan kategori di bawah judul --}}
                                @if (isset($kategoriData[$katKey]))
                                    <span class="badge bg-light text-dark mb-1">
                                        <i class="{{ $kategoriData[$katKey]['icon'] }} me-1"></i>
                                        {{ $kategoriData[$katKey]['nama'] }}
                                    </span><br>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>
@endsection
