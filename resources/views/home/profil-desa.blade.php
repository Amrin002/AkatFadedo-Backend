@extends('layouts.main')
@push('styles')
    <style>
        /* ====================
                                                                                                                       GAYA UNTUK SETIAP SEKSI - Konsisten dengan home.index
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

        .card-potensi,
        .card-layanan,
        .card-berita,
        .card-statistik {
            border-radius: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-potensi:hover,
        .card-layanan:hover,
        .card-berita:hover,
        .card-statistik:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .progress-bar-custom {
            height: 25px;
            border-radius: 15px;
        }

        .info-card-profil {
            border-left: 4px solid #0DCAF0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 1rem;
        }

        .apbdes-card {
            background: linear-gradient(135deg, #0DCAF0 0%, #3FBBC0 100%);
            color: white;
            border-radius: 1rem;
        }

        .facility-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section Profil Desa -->
    <section id="beranda" class="hero-section">
        <div class="container p-4">
            <h1 class="mb-4 display-4 fw-bold reveal">Profil Desa Akat Fadedo</h1>
            <p class="mb-5 lead reveal">Data lengkap dan analisis mendalam tentang kondisi demografis, ekonomi, dan
                pembangunan desa</p>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="/" class="text-white">Beranda</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Profil Desa</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Statistik Demografis Lengkap -->
    <section id="statistik" class="py-5 my-5">
        <div class="container">
            <h2 class="text-center section-title">Demografis Penduduk</h2>

            <!-- Statistik Utama - Menggunakan struktur yang sama dengan home -->
            <div class="text-center row g-4 justify-content-center mb-5">
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-users fa-3x text-primary"></i>
                            <h3 class="card-title h1 fw-bold text-muted">
                                {{ number_format($statistikDemografi['total_penduduk']) }}</h3>
                            <p class="card-text text-muted">Total Penduduk</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-house-user fa-3x text-success"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ number_format($jumlahKk) }}</h3>
                            <p class="card-text text-muted">Kepala Keluarga</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-chart-line fa-3x text-info"></i>
                            <h3 class="card-title h1 fw-bold text-muted">
                                {{ $rasioKetergantungan['rasio_ketergantungan_total'] }}%</h3>
                            <p class="card-text text-muted">Rasio Ketergantungan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-balance-scale fa-3x text-warning"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ $sexRatio }}</h3>
                            <p class="card-text text-muted">Sex Ratio (L/P)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Distribusi Umur -->
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="p-4 shadow-sm card">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="p-3 me-4 bg-primary bg-opacity-10 d-inline-block rounded">
                                <i class="fas fa-chart-pie fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">Distribusi Penduduk Berdasarkan Kelompok Umur</h5>
                                <p class="mb-0 text-muted">Breakdown demografi untuk analisis IDM</p>
                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="col-md-4 mb-3">
                                <div class="info-card-profil p-3">
                                    <i class="fas fa-child fa-2x text-info mb-2"></i>
                                    <h4 class="fw-bold text-primary">
                                        {{ number_format($statistikDemografi['anak_anak']['jumlah']) }}</h4>
                                    <p class="text-muted mb-1">Anak-anak (0-14 tahun)</p>
                                    <span class="badge bg-info">{{ $statistikDemografi['anak_anak']['persentase'] }}%</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-card-profil p-3">
                                    <i class="fas fa-user-tie fa-2x text-success mb-2"></i>
                                    <h4 class="fw-bold text-success">
                                        {{ number_format($statistikDemografi['usia_produktif']['jumlah']) }}</h4>
                                    <p class="text-muted mb-1">Usia Produktif (15-64 tahun)</p>
                                    <span
                                        class="badge bg-success">{{ $statistikDemografi['usia_produktif']['persentase'] }}%</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="info-card-profil p-3">
                                    <i class="fas fa-user-friends fa-2x text-warning mb-2"></i>
                                    <h4 class="fw-bold text-warning">
                                        {{ number_format($statistikDemografi['lansia']['jumlah']) }}</h4>
                                    <p class="text-muted mb-1">Lansia (65+ tahun)</p>
                                    <span
                                        class="badge bg-warning">{{ $statistikDemografi['lansia']['persentase'] }}%</span>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar Visualisasi -->
                        <div class="mt-4">
                            <label class="form-label fw-bold">Distribusi Umur (%)</label>
                            <div class="progress progress-bar-custom">
                                <div class="progress-bar bg-info"
                                    style="width: {{ $statistikDemografi['anak_anak']['persentase'] }}%">Anak-anak</div>
                                <div class="progress-bar bg-success"
                                    style="width: {{ $statistikDemografi['usia_produktif']['persentase'] }}%">Produktif
                                </div>
                                <div class="progress-bar bg-warning"
                                    style="width: {{ $statistikDemografi['lansia']['persentase'] }}%">Lansia</div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Indikator IDM -->
                <div class="col-lg-4">
                    <div class="p-4 shadow-sm card h-100">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="p-3 me-4 bg-success bg-opacity-10 d-inline-block rounded">
                                <i class="fas fa-award fa-2x text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">Indeks Desa Membangun</h5>
                                <p class="mb-0 text-muted">Status dan kategori desa</p>
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            <div class="display-4 fw-bold text-success">{{ $analisisIdm['skor'] }}</div>
                            <h5 class="text-success">DESA {{ $analisisIdm['kategori'] }}</h5>
                        </div>

                        <ul class="list-unstyled">
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-muted">Bonus Demografi:</span>
                                <span
                                    class="badge bg-{{ $analisisIdm['bonus_demografi'] == 'Optimal' ? 'success' : 'warning' }}">{{ $analisisIdm['bonus_demografi'] }}
                                    ({{ $statistikDemografi['usia_produktif']['persentase'] }}%)</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-muted">Sex Ratio (L/P):</span>
                                <span
                                    class="badge bg-{{ $analisisIdm['sex_ratio_status'] == 'Seimbang' ? 'success' : 'warning' }}">{{ $analisisIdm['sex_ratio_status'] }}
                                    ({{ $sexRatio }})</span>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span class="text-muted">Rata-rata Anggota KK:</span>
                                <span
                                    class="badge bg-{{ $rataAnggotaKK <= 4 ? 'success' : ($rataAnggotaKK <= 6 ? 'warning' : 'danger') }}">{{ $rataAnggotaKK <= 4 ? 'Ideal' : ($rataAnggotaKK <= 6 ? 'Sedang' : 'Tinggi') }}
                                    ({{ $rataAnggotaKK }} orang)</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Persebaran Wilayah -->
    {{-- <section class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="text-center section-title">Persebaran Penduduk per Wilayah</h2>
            <div class="row g-4">
                <div class="col-lg-6 col-md-6 reveal">
                    <div class="p-4 shadow-sm card info-card-profil">
                        <div class="mb-3 d-flex align-items-center">
                            <div class="p-2 me-3 bg-info bg-opacity-10 d-inline-block rounded">
                                <i class="fas fa-map-marker-alt text-info"></i>
                            </div>
                            <h5 class="mb-0 fw-bold">Dusun Utara</h5>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="mb-1 text-muted"><strong>RT 001:</strong> 45 KK (178 jiwa)</p>
                                <p class="mb-1 text-muted"><strong>RT 002:</strong> 38 KK (152 jiwa)</p>
                            </div>
                            <div class="col-6">
                                <p class="mb-1 fw-bold text-info">RW 001</p>
                                <p class="text-muted">Total: 83 KK (330 jiwa)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 reveal">
                    <div class="p-4 shadow-sm card info-card-profil">
                        <div class="mb-3 d-flex align-items-center">
                            <div class="p-2 me-3 bg-success bg-opacity-10 d-inline-block rounded">
                                <i class="fas fa-map-marker-alt text-success"></i>
                            </div>
                            <h5 class="mb-0 fw-bold">Dusun Selatan</h5>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="mb-1 text-muted"><strong>RT 003:</strong> 52 KK (205 jiwa)</p>
                                <p class="mb-1 text-muted"><strong>RT 004:</strong> 41 KK (163 jiwa)</p>
                            </div>
                            <div class="col-6">
                                <p class="mb-1 fw-bold text-success">RW 002</p>
                                <p class="text-muted">Total: 93 KK (368 jiwa)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 reveal">
                    <div class="p-4 shadow-sm card info-card-profil">
                        <div class="mb-3 d-flex align-items-center">
                            <div class="p-2 me-3 bg-warning bg-opacity-10 d-inline-block rounded">
                                <i class="fas fa-map-marker-alt text-warning"></i>
                            </div>
                            <h5 class="mb-0 fw-bold">Dusun Timur</h5>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="mb-1 text-muted"><strong>RT 005:</strong> 47 KK (187 jiwa)</p>
                                <p class="mb-1 text-muted"><strong>RT 006:</strong> 35 KK (139 jiwa)</p>
                            </div>
                            <div class="col-6">
                                <p class="mb-1 fw-bold text-warning">RW 003</p>
                                <p class="text-muted">Total: 82 KK (326 jiwa)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 reveal">
                    <div class="p-4 shadow-sm card info-card-profil">
                        <div class="mb-3 d-flex align-items-center">
                            <div class="p-2 me-3 bg-danger bg-opacity-10 d-inline-block rounded">
                                <i class="fas fa-map-marker-alt text-danger"></i>
                            </div>
                            <h5 class="mb-0 fw-bold">Dusun Barat</h5>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="mb-1 text-muted"><strong>RT 007:</strong> 32 KK (127 jiwa)</p>
                                <p class="mb-1 text-muted"><strong>RT 008:</strong> 22 KK (86 jiwa)</p>
                            </div>
                            <div class="col-6">
                                <p class="mb-1 fw-bold text-danger">RW 004</p>
                                <p class="text-muted">Total: 54 KK (213 jiwa)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Transparansi APBDes -->
    <section id="transparansi" class="py-5 my-5">
        <div class="container">
            <h2 class="text-center section-title">Transparansi Keuangan Desa</h2>

            <!-- Summary APBDes - Menggunakan struktur seperti home -->
            <div class="text-center row g-4 justify-content-center reveal mb-5">
                <div class="col-12 col-md-10 col-lg-8 d-flex">
                    <div class="p-4 apbdes-card w-100">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                @if ($apbdes)
                                    <h3 class="fw-bold mb-2">APBDes Tahun {{ $apbdes->tahun }}</h3>
                                    <h2 class="display-6 fw-bold">{{ $apbdes->formatRupiah($apbdes->pendapatan) }}</h2>
                                    <p class="mb-0">Total Anggaran Pendapatan dan Belanja Desa</p>

                                    @if ($analisisApbdes)
                                        <small class="d-block mt-2">
                                            <strong>Realisasi:</strong> {{ $analisisApbdes['persentase_realisasi'] }}%
                                            <span
                                                class="badge bg-{{ $analisisApbdes['is_seimbang'] ? 'success' : 'warning' }} ms-2">
                                                {{ $analisisApbdes['is_seimbang'] ? 'Seimbang' : 'Defisit' }}
                                            </span>
                                        </small>
                                    @endif
                                @else
                                    <h3 class="fw-bold mb-2">APBDes</h3>
                                    <p class="mb-0">Data APBDes belum tersedia</p>
                                @endif
                            </div>
                            <div class="col-lg-4 text-lg-end">
                                @if ($apbdes)
                                    <p class="mb-1"><strong>Disahkan oleh:</strong> {{ $apbdes->pejabat }}</p>
                                    <p class="mb-0"><small>Kepala Desa Akat Fadedo</small></p>

                                    @if ($analisisApbdes && $analisisApbdes['tren'])
                                        <div class="mt-2">
                                            <small class="text-light">
                                                vs {{ $analisisApbdes['tren']['tahun_sebelumnya'] }}:
                                                <span
                                                    class="badge bg-{{ $analisisApbdes['tren']['status'] == 'naik' ? 'success' : ($analisisApbdes['tren']['status'] == 'turun' ? 'danger' : 'secondary') }}">
                                                    {{ $analisisApbdes['tren']['persentase_perubahan'] > 0 ? '+' : '' }}{{ $analisisApbdes['tren']['persentase_perubahan'] }}%
                                                </span>
                                            </small>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Breakdown APBDes -->
            @if ($apbdes && $analisisApbdes)
                <div class="row g-4">
                    <div class="col-lg-6 col-md-6 d-flex reveal">
                        <div class="p-4 shadow-sm card w-100">
                            <div class="mb-3 d-flex align-items-center">
                                <div class="p-3 me-3 bg-info bg-opacity-10 d-inline-block rounded">
                                    <i class="fas fa-building fa-2x text-info"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Penyelenggaraan Pemerintahan</h5>
                                    <h4 class="mb-0 fw-bold text-info">
                                        {{ $apbdes->formatRupiah($apbdes->penyelenggaraan) }}</h4>
                                </div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-info"
                                    style="width: {{ $analisisApbdes['persentase_alokasi']['penyelenggaraan'] }}%"></div>
                            </div>
                            <small class="text-muted">{{ $analisisApbdes['persentase_alokasi']['penyelenggaraan'] }}% dari
                                total pengeluaran</small>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex reveal">
                        <div class="p-4 shadow-sm card w-100">
                            <div class="mb-3 d-flex align-items-center">
                                <div class="p-3 me-3 bg-success bg-opacity-10 d-inline-block rounded">
                                    <i class="fas fa-hammer fa-2x text-success"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Pelaksanaan Pembangunan</h5>
                                    <h4 class="mb-0 fw-bold text-success">
                                        {{ $apbdes->formatRupiah($apbdes->pelaksanaan) }}</h4>
                                </div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-success"
                                    style="width: {{ $analisisApbdes['persentase_alokasi']['pelaksanaan'] }}%"></div>
                            </div>
                            <small class="text-muted">{{ $analisisApbdes['persentase_alokasi']['pelaksanaan'] }}% dari
                                total pengeluaran</small>

                            @if ($analisisApbdes['bidang_terbesar']['bidang'] == 'Pelaksanaan Pembangunan')
                                <div class="mt-2">
                                    <span class="badge bg-success">Alokasi Terbesar</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex reveal">
                        <div class="p-4 shadow-sm card w-100">
                            <div class="mb-3 d-flex align-items-center">
                                <div class="p-3 me-3 bg-warning bg-opacity-10 d-inline-block rounded">
                                    <i class="fas fa-users fa-2x text-warning"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Pembinaan Kemasyarakatan</h5>
                                    <h4 class="mb-0 fw-bold text-warning">{{ $apbdes->formatRupiah($apbdes->pembinaan) }}
                                    </h4>
                                </div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-warning"
                                    style="width: {{ $analisisApbdes['persentase_alokasi']['pembinaan'] }}%"></div>
                            </div>
                            <small class="text-muted">{{ $analisisApbdes['persentase_alokasi']['pembinaan'] }}% dari total
                                pengeluaran</small>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex reveal">
                        <div class="p-4 shadow-sm card w-100">
                            <div class="mb-3 d-flex align-items-center">
                                <div class="p-3 me-3 bg-secondary bg-opacity-10 d-inline-block rounded">
                                    <i class="fas fa-hand-holding-heart fa-2x text-secondary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Pemberdayaan Masyarakat</h5>
                                    <h4 class="mb-0 fw-bold text-secondary">
                                        {{ $apbdes->formatRupiah($apbdes->pemberdayaan) }}</h4>
                                </div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-secondary"
                                    style="width: {{ $analisisApbdes['persentase_alokasi']['pemberdayaan'] }}%"></div>
                            </div>
                            <small class="text-muted">{{ $analisisApbdes['persentase_alokasi']['pemberdayaan'] }}% dari
                                total pengeluaran</small>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 d-flex reveal">
                        <div class="p-4 shadow-sm card w-100">
                            <div class="mb-3 d-flex align-items-center">
                                <div class="p-3 me-3 bg-danger bg-opacity-10 d-inline-block rounded">
                                    <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Penanggulangan Bencana</h5>
                                    <h4 class="mb-0 fw-bold text-danger">
                                        {{ $apbdes->formatRupiah($apbdes->penanggulangan) }}</h4>
                                </div>
                            </div>
                            <div class="progress mb-2">
                                <div class="progress-bar bg-danger"
                                    style="width: {{ $analisisApbdes['persentase_alokasi']['penanggulangan'] }}%"></div>
                            </div>
                            <small class="text-muted">{{ $analisisApbdes['persentase_alokasi']['penanggulangan'] }}% dari
                                total pengeluaran</small>
                        </div>
                    </div>
                </div>


                <!-- Analisis dan Rekomendasi APBDes -->
                @if ($analisisApbdes['rekomendasi'])
                    <div class="row mt-4">
                        <div class="col-12 reveal">
                            <div class="alert alert-info">
                                <h6 class="alert-heading">
                                    <i class="fas fa-lightbulb me-2"></i>Rekomendasi Pengelolaan Anggaran
                                </h6>
                                <ul class="mb-0">
                                    @foreach ($analisisApbdes['rekomendasi'] as $rekomendasi)
                                        <li>{{ $rekomendasi }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </section>
    <!-- Fasilitas Desa -->
    {{-- <section id="layanan" class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="text-center section-title">Fasilitas & Infrastruktur Desa</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-school fa-3x text-info"></i>
                            <h3 class="mb-2 card-title h4">Pendidikan</h3>
                            <ul class="list-unstyled text-muted">
                                <li>• SD Negeri: 2 unit</li>
                                <li>• PAUD: 1 unit</li>
                                <li>• Perpustakaan: 1 unit</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-hospital fa-3x text-success"></i>
                            <h3 class="mb-2 card-title h4">Kesehatan</h3>
                            <ul class="list-unstyled text-muted">
                                <li>• Puskesmas: 1 unit</li>
                                <li>• Posyandu: 4 unit</li>
                                <li>• Polindes: 1 unit</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-pray fa-3x text-warning"></i>
                            <h3 class="mb-2 card-title h4">Ibadah</h3>
                            <ul class="list-unstyled text-muted">
                                <li>• Masjid: 3 unit</li>
                                <li>• Musholla: 8 unit</li>
                                <li>• Gereja: 1 unit</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-road fa-3x text-danger"></i>
                            <h3 class="mb-2 card-title h4">Infrastruktur</h3>
                            <ul class="list-unstyled text-muted">
                                <li>• Jalan Aspal: 12 km</li>
                                <li>• Jalan Tanah: 8 km</li>
                                <li>• Jembatan: 3 unit</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Analisis & Rekomendasi -->
    {{-- <section class="py-5 my-5">
        <div class="container">
            <h2 class="text-center section-title">Analisis & Rekomendasi Pembangunan</h2>
            <div class="row g-4">
                <div class="col-lg-6 reveal">
                    <div class="p-4 shadow-sm card h-100">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="p-3 me-4 bg-primary bg-opacity-10 d-inline-block rounded">
                                <i class="fas fa-chart-line fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">Analisis Demografis</h5>
                                <p class="mb-0 text-muted">Kondisi dan potensi penduduk desa</p>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <strong>Bonus Demografi Optimal</strong><br>
                            Dengan 67% penduduk usia produktif, desa memiliki potensi besar untuk pembangunan ekonomi.
                        </div>
                        <div class="alert alert-info">
                            <strong>Keseimbangan Gender Baik</strong><br>
                            Sex ratio 102.3 menunjukkan distribusi gender yang ideal untuk keberlanjutan generasi.
                        </div>
                        <div class="alert alert-warning">
                            <strong>Perhatian Khusus Lansia</strong><br>
                            9.1% lansia memerlukan program kesehatan dan bantuan sosial yang memadai.
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <div class="p-4 shadow-sm card h-100">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="p-3 me-4 bg-success bg-opacity-10 d-inline-block rounded">
                                <i class="fas fa-lightbulb fa-2x text-success"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">Rekomendasi Pembangunan</h5>
                                <p class="mb-0 text-muted">Prioritas pengembangan desa</p>
                            </div>
                        </div>

                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Prioritas 1:</strong> Pengembangan pelatihan keterampilan untuk memanfaatkan bonus
                                demografi
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Prioritas 2:</strong> Pembangunan infrastruktur ekonomi dan UMKM
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Prioritas 3:</strong> Peningkatan fasilitas pendidikan dan kesehatan
                            </li>
                            <li class="mb-3">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <strong>Prioritas 4:</strong> Program pemberdayaan perempuan dan keluarga berencana
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Download Center -->
    <section class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="text-center section-title">Dokumen & Download</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-file-pdf fa-3x text-danger"></i>
                            <h3 class="mb-2 card-title h4">APBDes 2024</h3>
                            <p class="card-text text-muted">Dokumen lengkap Anggaran Pendapatan dan Belanja Desa</p>
                            <a href="#" class="mt-3 btn btn-sm btn-danger rounded-pill">Download PDF</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-file-excel fa-3x text-success"></i>
                            <h3 class="mb-2 card-title h4">Data Demografis</h3>
                            <p class="card-text text-muted">Data lengkap kependudukan dan statistik desa</p>
                            <a href="#" class="mt-3 btn btn-sm btn-success rounded-pill">Download Excel</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-file-alt fa-3x text-primary"></i>
                            <h3 class="mb-2 card-title h4">Profil Lengkap</h3>
                            <p class="card-text text-muted">Dokumen profil desa dan rencana pembangunan</p>
                            <a href="#" class="mt-3 btn btn-sm btn-primary rounded-pill">Download DOC</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Animasi scroll reveal untuk profil desa - konsisten dengan home
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
