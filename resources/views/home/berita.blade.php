@extends('layouts.main')

@section('content')
    <main class="container py-5" style="margin-top: 70px; max-width: 1200px;">
        <div class="row g-4">
            {{-- KONTEN UTAMA --}}
            <div class="col-lg-8">
                {{-- Breadcrumb --}}
                <div class="mb-3">
                    <a href="{{ route('home.daftar-berita') }}" 
                       class="text-decoration-none text-info fw-semibold link-back">
                        <i class="fas fa-newspaper me-1"></i> Berita Desa Akat Fadedo
                    </a>
                </div>

                {{-- Judul --}}
                <h2 class="fw-bolder text-dark mb-3 berita-judul">
                    {{ $berita->judul }}
                </h2>

                {{-- Meta Info --}}
                <div class="d-flex flex-wrap align-items-center text-muted mb-3 meta-info">
                    <span class="me-3">
                        <i class="far fa-calendar-alt me-1"></i> {{ $berita->created_at->format('d F Y') }}
                    </span>
                    <span class="me-3">
                        <i class="fas fa-user me-1"></i> {{ $berita->user->name ?? 'Administrator' }}
                    </span>
                    <span>
                        <i class="fas fa-eye me-1"></i> Dilihat {{ $berita->views ?? 0 }} kali
                    </span>
                </div>

                {{-- Gambar Utama --}}
                <div class="mb-3 text-center">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" 
                        class="img-fluid rounded shadow-sm w-100 berita-gambar"
                        alt="{{ $berita->judul }}"
                        style="cursor: zoom-in;"
                        data-bs-toggle="modal"
                        data-bs-target="#imageModal">
                </div>

                {{-- Modal Fullscreen untuk Gambar --}}
                <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
                        <div class="modal-content bg-dark border-0">
                            <div class="modal-body p-0 text-center">
                                <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                    class="img-fluid w-100 h-100 object-fit-contain"
                                    alt="{{ $berita->judul }}">
                                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                                        data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Badge Kategori --}}
                @if (isset($kategoriData[$kategoriKey]))
                    <div class="mb-4">
                        <span class="badge {{ $kategoriData[$kategoriKey]['class'] }} px-3 py-2 shadow-sm">
                            <i class="{{ $kategoriData[$kategoriKey]['icon'] }} me-1"></i>
                            {{ $kategoriData[$kategoriKey]['nama'] }}
                        </span>
                    </div>
                @endif

                {{-- Konten Berita --}}
                <article class="fs-6 konten-berita">
                    {!! $berita->konten !!}
                </article>
            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-3 text-info">
                            <i class="fas fa-clock me-2"></i> Berita Terbaru
                        </h5>
                        @foreach ($berita_terbaru as $item)
                            @php
                                $katKey = strtolower(trim($item->kategori));
                                $kat = $kategoriData[$katKey] ?? null;
                            @endphp
                            <a href="{{ route('home.berita', $item->slug) }}" 
                               class="text-dark text-decoration-none">
                                <div class="d-flex mb-3 p-2 rounded sidebar-item">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                                         alt="" 
                                         class="me-2 rounded sidebar-img">
                                    <div class="flex-grow-1">
                                        <p class="mb-1 fw-semibold sidebar-title">
                                            {{ \Illuminate\Support\Str::limit($item->judul, 50) }}
                                        </p>

                                        <small class="text-muted d-block">
                                            <i class="far fa-calendar-alt me-1"></i> {{ $item->created_at->format('d M Y') }}
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="fas fa-eye me-1"></i> {{ $item->views ?? 0 }} kali
                                        </small>

                                        {{-- Kategori --}}
                                        @if ($kat)
                                            <span class="badge {{ $kat['class'] }} mt-1">
                                                <i class="{{ $kat['icon'] }} me-1"></i>
                                                {{ $kat['nama'] }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
<style>
    /* Judul berita */
    .berita-judul {
        font-size: 2rem;
        line-height: 1.4;
    }

    /* Gambar utama */
    .berita-gambar {
        max-height: 450px;
        object-fit: cover;
    }

    /* Konten */
    .konten-berita {
        line-height: 1.8;
        text-align: justify;
    }

    /* Link back hover */
    .link-back {
        transition: color 0.3s ease, text-shadow 0.3s ease;
    }
    .link-back:hover {
        color: #0d6efd;
        text-shadow: 0 1px 5px rgba(0,0,0,0.2);
    }

    /* Sidebar */
    .sidebar-item {
        transition: background 0.3s ease, transform 0.3s ease;
    }
    .sidebar-item:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
    }
    .sidebar-img {
        width: 100px;
        height: 80px;
        object-fit: cover;
    }
    .sidebar-title {
        font-size: 0.95rem;
        transition: color 0.3s ease;
    }
    .sidebar-title:hover {
        color: #0d6efd;
    }
</style>
@endpush
