@extends('layouts.main')
@push('styles')
    <style>
        /* ====================
                                                                                                                                                               GAYA UNTUK INDEX UMKM PUBLIC - Konsisten dengan Detail
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

        /* Clickable Card Styles */
        .clickable-card {
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .clickable-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.2) !important;
        }

        .clickable-card:active {
            transform: translateY(-5px) scale(1.01);
        }

        /* Focus state untuk aksesibilitas keyboard */
        .clickable-card:focus {
            outline: 3px solid #0DCAF0;
            outline-offset: 2px;
        }

        .card-umkm:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .card-statistik {
            border-radius: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-statistik:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .filter-card {
            background-color: #f8f9fa;
            border-radius: 1rem;
            border: 1px solid #dee2e6;
        }

        .category-badge {
            background-color: #0DCAF0;
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .search-input {
            border-radius: 25px;
            border: 1px solid #dee2e6;
            padding: 10px 20px;
        }

        .search-input:focus {
            border-color: #0DCAF0;
            box-shadow: 0 0 0 0.2rem rgba(13, 202, 240, 0.25);
        }

        /* Modal Styles */
        .modal-content {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
        }

        .alert-info {
            background-color: rgba(13, 202, 240, 0.1);
            border-color: #0DCAF0;
            color: #0A58CA;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section UMKM -->
    <section id="beranda" class="hero-section">
        <div class="container p-4">
            <h1 class="mb-4 display-4 fw-bold reveal">UMKM Desa Akat Fadedo</h1>
            <p class="mb-5 lead reveal">Produk unggulan dan usaha kreatif masyarakat desa</p>
            <div class="reveal">
                <span class="badge bg-light text-dark fs-6 px-3 py-2">
                    <i class="fas fa-store me-2"></i>{{ $totalUmkm }} UMKM Terdaftar
                </span>
            </div>
            <nav aria-label="breadcrumb" class="mt-4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="/" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">UMKM</li>
                </ol>
            </nav>
        </div>
    </section>
    <!-- Filter dan Pencarian -->
    <section class="py-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="filter-card p-4 reveal">
                        <form method="GET" action="{{ route('umkm.public.index') }}">
                            <div class="row g-3 align-items-center">
                                <!-- Pencarian -->
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="fas fa-search text-muted"></i>
                                        </span>
                                        <input type="text" name="search"
                                            class="form-control search-input border-start-0"
                                            placeholder="Cari nama usaha, produk, atau pemilik..."
                                            value="{{ $search }}">
                                    </div>
                                </div>

                                <!-- Filter Kategori -->
                                <div class="col-lg-4">
                                    <select name="kategori" class="form-select search-input">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($kategoriOptions as $key => $label)
                                            <option value="{{ $key }}" {{ $kategori == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tombol Filter -->
                                <div class="col-lg-2">
                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary rounded-pill flex-fill">
                                            <i class="fas fa-filter me-1"></i>Filter
                                        </button>
                                        <a href="{{ route('umkm.public.index') }}"
                                            class="btn btn-outline-secondary rounded-pill">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik UMKM -->
    <section id="statistik" class="py-5 my-5">
        <div class="container">
            <h2 class="text-center section-title">Statistik UMKM</h2>
            <div class="text-center row g-4 justify-content-center mb-5">
                <!-- Total UMKM -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-store fa-3x text-primary"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ $totalUmkm }}</h3>
                            <p class="card-text text-muted">Total UMKM</p>
                        </div>
                    </div>
                </div>

                <!-- Makanan & Minuman -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-utensils fa-3x text-success"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ $totalByKategori['makanan'] ?? 0 }}</h3>
                            <p class="card-text text-muted">Makanan & Minuman</p>
                        </div>
                    </div>
                </div>

                <!-- Kerajinan -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-hammer fa-3x text-info"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ $totalByKategori['kerajinan'] ?? 0 }}</h3>
                            <p class="card-text text-muted">Kerajinan</p>
                        </div>
                    </div>
                </div>

                <!-- Jasa -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-handshake fa-3x text-warning"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ $totalByKategori['jasa'] ?? 0 }}</h3>
                            <p class="card-text text-muted">Jasa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Daftar UMKM -->
    <section class="py-5 my-5">
        <div class="container">
            @if ($kategori || $search)
                <div class="mb-4 text-center">
                    <h3>Hasil Pencarian</h3>
                    <p class="text-muted">
                        @if ($search)
                            Pencarian: "<strong>{{ $search }}</strong>"
                        @endif
                        @if ($kategori)
                            Kategori: <strong>{{ $kategoriOptions[$kategori] }}</strong>
                        @endif
                    </p>
                </div>
            @endif

            @if ($umkms->count() > 0)
                <div class="row g-4">
                    @foreach ($umkms as $umkm)
                        <div class="col-lg-4 col-md-6 d-flex reveal">
                            <!-- Buat card menjadi clickable -->
                            <div class="card card-umkm w-100 clickable-card"
                                onclick="window.location.href='{{ route('umkm.public.show', $umkm->id) }}'" role="button"
                                tabindex="0"
                                onkeypress="if(event.key === 'Enter') window.location.href='{{ route('umkm.public.show', $umkm->id) }}'">
                                <img src="{{ asset('storage/' . $umkm->foto_produk) }}" class="card-img-top"
                                    alt="{{ $umkm->nama_produk }}" style="height: 250px; object-fit: cover;">
                                <div class="card-body p-4">
                                    <!-- Header Card -->
                                    <div class="text-center mb-3">
                                        <span class="category-badge mb-2">{{ $umkm->kategori_label }}</span>
                                        <h5 class="card-title fw-bold">{{ $umkm->nama_usaha }}</h5>
                                        <h6 class="card-subtitle text-muted">{{ $umkm->nama_produk }}</h6>
                                        @if ($umkm->harga_produk)
                                            <div class="text-center mb-2">
                                                <span class="fw-bold text-success h5">
                                                    Rp {{ number_format($umkm->harga_produk, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Pemilik -->
                                    <div class="text-center mb-3">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user-circle text-primary me-2"></i>
                                            <small
                                                class="text-muted">{{ $umkm->penduduk->nama_lengkap ?? 'Pemilik UMKM' }}</small>
                                        </div>
                                    </div>

                                    <!-- Deskripsi -->
                                    <p class="card-text text-center text-muted">
                                        {{ Str::limit($umkm->deskripsi_produk, 100) }}
                                    </p>

                                    <!-- Tombol Aksi -->
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- Tombol Detail dihapus karena card sudah clickable -->
                                        <span class="text-muted small">
                                            <i class="fas fa-eye me-1"></i>Klik untuk detail
                                        </span>
                                        <!-- WhatsApp button dengan event.stopPropagation() agar tidak trigger card click -->
                                        <a href="{{ $umkm->whatsapp_url }}" target="_blank"
                                            class="btn btn-success btn-sm rounded-pill"
                                            onclick="event.stopPropagation();">
                                            <i class="fab fa-whatsapp me-1"></i>Hubungi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $umkms->appends(request()->query())->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Tidak ada UMKM ditemukan</h4>
                    <p class="text-muted">
                        @if ($search || $kategori)
                            Coba ubah kata kunci pencarian atau pilih kategori lain.
                        @else
                            Belum ada UMKM yang terdaftar saat ini.
                        @endif
                    </p>
                    @if ($search || $kategori)
                        <a href="{{ route('umkm.public.index') }}" class="btn btn-primary rounded-pill">
                            <i class="fas fa-arrow-left me-2"></i>Lihat Semua UMKM
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <!-- Call to Action dengan Modal -->
    <section class="py-5 my-5 bg-white">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="mb-4">Bergabung dengan UMKM Desa</h2>
                    <p class="lead text-muted mb-4">
                        Punya usaha dan ingin bergabung dengan komunitas UMKM Desa Akat Fadedo?
                        Daftarkan usaha Anda sekarang!
                    </p>
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                        <button type="button" class="btn btn-primary btn-lg rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#infoModal">
                            <i class="fas fa-info-circle me-2"></i>Info Pendaftaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Info Pendaftaran UMKM -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0" style="border-radius: 1rem;">
                <div class="modal-header bg-primary text-white" style="border-radius: 1rem 1rem 0 0;">
                    <h5 class="modal-title fw-bold" id="infoModalLabel">
                        <i class="fas fa-store me-2"></i>Informasi Pendaftaran UMKM
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <!-- Kiri - Info Aplikasi -->
                        <div class="col-md-6">
                            <div class="text-center mb-4">
                                <i class="fas fa-mobile-alt fa-3x text-primary mb-3"></i>
                                <h5 class="fw-bold text-primary">Daftar via Aplikasi LAYANAN DESA</h5>
                            </div>

                            <div class="bg-light p-3 rounded mb-3">
                                <h6 class="fw-bold mb-2">
                                    <i class="fas fa-download text-success me-2"></i>Langkah 1: Download Aplikasi
                                </h6>
                                <p class="small mb-2">Download aplikasi LAYANAN DESA di smartphone Android Anda</p>
                                <div class="text-center">
                                    @if ($latestAppVersion)
                                        <a href="{{ $latestAppVersion->full_download_url }}" download
                                            class="btn btn-success btn-sm rounded-pill">
                                            <i class="fab fa-android me-1"></i>Download APK
                                            v{{ $latestAppVersion->version }}
                                        </a>
                                        <div class="mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Ukuran: {{ $latestAppVersion->file_size }} |
                                                Rilis: {{ $latestAppVersion->formatted_release_date }}
                                            </small>
                                        </div>
                                    @else
                                        <button class="btn btn-secondary btn-sm rounded-pill" disabled>
                                            <i class="fab fa-android me-1"></i>APK Belum Tersedia
                                        </button>
                                        <div class="mt-2">
                                            <small class="text-muted">Aplikasi sedang dalam pengembangan</small>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="bg-light p-3 rounded mb-3">
                                <h6 class="fw-bold mb-2">
                                    <i class="fas fa-user-plus text-info me-2"></i>Langkah 2: Registrasi
                                </h6>
                                <p class="small mb-0">Daftar menggunakan NIK sebagai warga Desa Akat Fadedo</p>
                            </div>

                            <div class="bg-light p-3 rounded mb-3">
                                <h6 class="fw-bold mb-2">
                                    <i class="fas fa-store text-warning me-2"></i>Langkah 3: Daftar UMKM
                                </h6>
                                <p class="small mb-0">Pilih menu UMKM dan isi formulir pendaftaran usaha Anda</p>
                            </div>

                            <div class="bg-light p-3 rounded">
                                <h6 class="fw-bold mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>Langkah 4: Verifikasi
                                </h6>
                                <p class="small mb-0">Tunggu verifikasi dari admin desa (1-3 hari kerja)</p>
                            </div>
                        </div>

                        <!-- Kanan - Info Kontak -->
                        <div class="col-md-6">
                            <div class="text-center mb-4">
                                <i class="fas fa-headset fa-3x text-success mb-3"></i>
                                <h5 class="fw-bold text-success">Bantuan Pendaftaran</h5>
                            </div>

                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-lightbulb me-2"></i>Kesulitan Mendaftar?
                                </h6>
                                <p class="mb-0 small">
                                    Jika mengalami kesulitan atau tidak memiliki smartphone Android,
                                    Anda dapat menghubungi admin desa untuk bantuan pendaftaran.
                                </p>
                            </div>

                            <div class="card border-success">
                                <div class="card-body text-center">
                                    <i class="fab fa-whatsapp fa-2x text-success mb-2"></i>
                                    <h6 class="card-title">Admin Desa Akat Fadedo</h6>
                                    <p class="card-text small text-muted mb-3">
                                        Hubungi admin untuk bantuan pendaftaran UMKM
                                    </p>
                                    <a href="https://wa.me/6282223607709?text=Halo%20Admin%2C%20saya%20ingin%20mendaftarkan%20UMKM%20saya"
                                        target="_blank" class="btn btn-success btn-sm rounded-pill">
                                        <i class="fab fa-whatsapp me-1"></i>Hubungi Admin
                                    </a>
                                </div>
                            </div>

                            <div class="mt-3">
                                <h6 class="fw-bold mb-2">Persyaratan Pendaftaran:</h6>
                                <ul class="list-unstyled small">
                                    <li><i class="fas fa-check text-success me-2"></i>Warga Desa Akat Fadedo (memiliki NIK)
                                    </li>
                                    <li><i class="fas fa-check text-success me-2"></i>Memiliki usaha aktif</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Foto produk/jasa yang jelas</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Nomor telepon aktif (WhatsApp)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light" style="border-radius: 0 0 1rem 1rem;">
                    <div class="w-100 text-center">
                        <p class="small text-muted mb-2">
                            <i class="fas fa-heart text-danger me-1"></i>
                            Desa Akat Fadedo - Mendukung Ekonomi Kreatif Masyarakat
                        </p>
                        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        // Auto submit form saat kategori berubah
        document.querySelector('select[name="kategori"]').addEventListener('change', function() {
            if (this.value !== '') {
                this.closest('form').submit();
            }
        });
    </script>
@endpush
