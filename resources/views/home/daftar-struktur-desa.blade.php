@extends('layouts.main')

@section('content')
    <main class="container py-5" style="margin-top: 70px;">
        <h2 class="mb-5 text-center fw-bolder text-dark" style="font-size:2.2rem;">Struktur Organisasi Desa Akat Fadedo</h2>

        {{-- Link Kembali --}}
        <div class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none text-info fw-semibold">
                <i class="fas fa-home me-1"></i> Kembali ke Home
            </a>
        </div>

        <div class="row gy-4 justify-content-center">
            @forelse ($strukturDesa as $anggota)
                <div class="col-lg-3 col-md-6 d-flex" 
                     data-aos="zoom-in" data-aos-duration="800" data-aos-delay="{{ $loop->index * 150 }}">
                    <div class="card team-card shadow-sm border-0 w-100 text-center">
                        <!-- Foto -->
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $anggota->image) }}" 
                                 class="img-fluid rounded-circle shadow-sm mb-3"
                                 alt="{{ $anggota->nama }}"
                                 style="width: 160px; height: 160px; object-fit: cover;">

                            <!-- Nama & Posisi -->
                            <h5 class="fw-bold mb-1">{{ $anggota->nama }}</h5>
                            <p class="text-muted small">{{ $anggota->posisi }}</p>

                            <!-- Sosial Media -->
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                @if ($anggota->twitter)
                                    <a href="{{ $anggota->twitter }}" target="_blank" class="social-icon twitter">
                                        <i class="bi bi-twitter-x"></i>
                                    </a>
                                @endif
                                @if ($anggota->facebook)
                                    <a href="{{ $anggota->facebook }}" target="_blank" class="social-icon facebook">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                @endif
                                @if ($anggota->instagram)
                                    <a href="{{ $anggota->instagram }}" target="_blank" class="social-icon instagram">
                                        <i class="bi bi-instagram"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Belum ada struktur desa yang tersedia.</div>
                </div>
            @endforelse
        </div>
    </main>
@endsection

@push('styles')
<style>
    /* Animasi masuk card */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .team-card {
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        position: relative;
        opacity: 0;
        animation: fadeUp 0.8s ease forwards;
    }
    .team-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    /* Foto */
    .team-card img {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }
    .team-card:hover img {
        transform: scale(1.08);
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }

    /* Info & Sosial animasi */
    .team-info,
    .social-icons {
        opacity: 0;
        transform: translateY(15px);
        transition: all 0.4s ease;
    }
    .team-card:hover .team-info,
    .team-card:hover .social-icons {
        opacity: 1;
        transform: translateY(0);
    }

    /* Ikon Sosial Media */
.social-icon {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1.1rem;
    color: #fff;
    transition: all 0.3s ease;
}

/* Brand colors resmi */
.social-icon.twitter { background: #000000; }     /* X (Twitter) hitam */
.social-icon.facebook { background: #1877F2; }   /* Biru Facebook */
.social-icon.instagram { 
    background: radial-gradient(circle at 30% 30%, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5); 
} /* Instagram gradient */
.social-icon.youtube { background: #FF0000; }    /* Merah YouTube */
.social-icon.linkedin { background: #0A66C2; }   /* Biru LinkedIn */
.social-icon.whatsapp { background: #25D366; }   /* Hijau WhatsApp */

/* Hover efek */
.social-icon:hover {
    transform: scale(1.15);
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
    text-decoration: none;
}

</style>
@endpush





@push('scripts')
<!-- Tambah AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();
</script>
@endpush
