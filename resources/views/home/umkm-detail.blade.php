@extends('layouts.main')
@push('styles')
    <style>
        /* ====================
                       GAYA UNTUK DETAIL UMKM - Sederhana dan Konsisten
                       ==================== */
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('landing/assets/img/hero-carousel/hero-carousel.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .card-umkm {
            border-radius: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .card-umkm:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            border-radius: 1rem;
            object-fit: cover;
            width: 100%;
            height: 400px;
        }

        .whatsapp-btn {
            background-color: #25D366;
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            color: white;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.3);
            width: 100%;
            justify-content: center;
        }

        .whatsapp-btn:hover {
            background-color: #128C7E;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
            color: white;
        }

        .category-badge {
            background-color: #0DCAF0;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: bold;
            display: inline-block;
            font-size: 0.9rem;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section Detail UMKM -->
    <section id="beranda" class="hero-section">
        <div class="container p-4">
            <h1 class="mb-4 display-4 fw-bold reveal">{{ $umkm->nama_usaha }}</h1>
            <p class="mb-5 lead reveal">{{ $umkm->nama_produk }}</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="/" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('umkm.public.index') }}" class="text-white">UMKM</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $umkm->nama_usaha }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Detail UMKM dalam Satu Card -->
    <section id="detail-umkm" class="py-5 my-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card card-umkm reveal">
                        <!-- Foto Produk -->
                        <img src="{{ asset('storage/' . $umkm->foto_produk) }}" alt="{{ $umkm->nama_produk }}"
                            class="card-img-top product-image">

                        <div class="card-body p-4">
                            <!-- Header Card -->
                            <div class="text-center mb-4">
                                <h2 class="fw-bold mb-2">{{ $umkm->nama_usaha }}</h2>
                                <h4 class="text-muted mb-3">{{ $umkm->nama_produk }}</h4>
                                <span class="category-badge">{{ $umkm->kategori_label }}</span>
                            </div>

                            <!-- Pemilik Usaha -->
                            <div class="text-center mb-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user-circle fa-2x text-primary me-2"></i>
                                    <div>
                                        <h5 class="mb-0">{{ $umkm->penduduk->nama_lengkap ?? 'Pemilik UMKM' }}</h5>
                                        <small class="text-muted">Pemilik Usaha</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi Produk -->
                            <div class="mb-4">
                                <h5 class="fw-bold mb-3">
                                    <i class="fas fa-info-circle text-primary me-2"></i>Deskripsi Produk
                                </h5>
                                <p class="text-justify" style="line-height: 1.8; font-size: 1.1rem;">
                                    {{ $umkm->deskripsi_produk }}
                                </p>
                            </div>

                            <!-- Tombol Hubungi -->
                            <div class="text-center">
                                <a href="{{ $umkm->whatsapp_url }}" target="_blank" class="whatsapp-btn">
                                    <i class="fab fa-whatsapp me-2 fa-lg"></i>
                                    Hubungi Pemilik Usaha
                                </a>
                            </div>

                            <!-- Media Sosial (Jika Ada) -->
                            @if ($umkm->link_facebook || $umkm->link_instagram || $umkm->link_tiktok)
                                <div class="text-center mt-4">
                                    <p class="fw-bold mb-2 text-muted">Ikuti juga di:</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        @if ($umkm->link_facebook)
                                            <a href="{{ $umkm->link_facebook }}" target="_blank"
                                                class="btn btn-outline-primary btn-sm rounded-pill">
                                                <i class="fab fa-facebook-f me-1"></i>Facebook
                                            </a>
                                        @endif
                                        @if ($umkm->link_instagram)
                                            <a href="{{ $umkm->link_instagram }}" target="_blank"
                                                class="btn btn-outline-danger btn-sm rounded-pill">
                                                <i class="fab fa-instagram me-1"></i>Instagram
                                            </a>
                                        @endif
                                        @if ($umkm->link_tiktok)
                                            <a href="{{ $umkm->link_tiktok }}" target="_blank"
                                                class="btn btn-outline-dark btn-sm rounded-pill">
                                                <i class="fab fa-tiktok me-1"></i>TikTok
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- UMKM Terkait -->
    <section class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="text-center section-title">UMKM Lainnya</h2>
            <p class="text-center text-muted mb-5">Kategori {{ $umkm->kategori_label }}</p>

            <div class="row g-4">
                @forelse($umkmTerkait as $item)
                    <div class="col-lg-4 col-md-6 d-flex reveal">
                        <div class="shadow-sm card card-umkm w-100">
                            <img src="{{ asset('storage/' . $item->foto_produk) }}" class="card-img-top"
                                alt="{{ $item->nama_produk }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <div class="text-center mb-2">
                                    <span class="badge bg-info mb-2">{{ $item->kategori_label }}</span>
                                </div>
                                <h5 class="card-title text-center">{{ $item->nama_usaha }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted text-center">{{ $item->nama_produk }}</h6>
                                <p class="card-text text-center">{{ Str::limit($item->deskripsi_produk, 80) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('umkm.public.show', $item->id) }}"
                                        class="btn btn-sm btn-outline-primary rounded-pill">Detail</a>
                                    <a href="{{ $item->whatsapp_url }}" target="_blank"
                                        class="btn btn-sm btn-success rounded-pill">
                                        <i class="fab fa-whatsapp me-1"></i>Hubungi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">Tidak ada UMKM lainnya dalam kategori ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Tombol Navigasi -->
            <div class="mt-5 text-center reveal">
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center align-items-center">
                    <a href="{{ route('umkm.public.index') }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar UMKM
                    </a>
                    <a href="{{ route('umkm.public.index', ['kategori' => $umkm->kategori]) }}"
                        class="btn btn-info rounded-pill px-4">
                        <i class="fas fa-filter me-2"></i>Lihat Semua {{ $umkm->kategori_label }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Animasi scroll reveal
        const revealElements = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2
        });

        revealElements.forEach(el => observer.observe(el));
    </script>
@endpush
