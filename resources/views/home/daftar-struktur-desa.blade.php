@extends('layouts.landing')

@section('content')
<main class="container py5">
    <div class="row">
    <div class="doctors section">
        <h2 class="mb-4 text-center fw-bold">Struktur Organisasi Desa Akat Fadedo</h2>
    
        <div class="text-left my-4">
            <a href="{{ route('home') }}" class="lihat-berita-link">
                <i class="fas fa-home me-1"></i>Home
            </a>
        </div>

        <div class="container">
            <div class="row gy-4">
                @forelse ($strukturDesa as $anggota)
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="{{ asset('storage/' . $anggota->image) }}" class="img-fluid"
                                    alt="{{ $anggota->nama }}" width="600" height="600">
                                <div class="social">
                                    @if ($anggota->twitter)
                                        <a href="{{ $anggota->twitter }}"><i class="bi bi-twitter-x"></i></a>
                                    @endif
                                    @if ($anggota->facebook)
                                        <a href="{{ $anggota->facebook }}"><i class="bi bi-facebook"></i></a>
                                    @endif
                                    @if ($anggota->instagram)
                                        <a href="{{ $anggota->instagram }}"><i class="bi bi-instagram"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="member-info text-center">
                                <h4 class="mb-1">{{ $anggota->nama }}</h4>
                                <span class="text-muted">{{ $anggota->posisi }}</span>
                            </div>
                            
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">Belum ada struktur-desa yang tersedia.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    </div>
</main>
@endsection
