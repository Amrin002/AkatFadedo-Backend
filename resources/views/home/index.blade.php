@extends('layouts.main')
@push('styles')
    <style>
        /* ====================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   GAYA UNTUK SETIAP SEKSI
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   ==================== */
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('landing/assets/img/hero-carousel/hero-carousel.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .card-potensi,
        .card-layanan,
        .card-berita,
        .card-statistik,
        .card-umkm {
            border-radius: 1rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-potensi:hover,
        .card-layanan:hover,
        .card-berita:hover,
        .card-statistik:hover,
        .card-umkm:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .img-gallery {
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .img-gallery:hover img {
            transform: scale(1.1);
        }

        .img-gallery img {
            transition: transform 0.3s ease;
        }
    </style>
@endpush
@section('content')
    <!-- Bagian Hero -->
    <section id="beranda" class="hero-section">
        <div class="container p-4">
            <h1 class="mb-4 display-3 fw-bold reveal">Selamat Datang di Desa Akat Fadedo</h1>
            <p class="mb-5 lead reveal">Membangun desa yang maju dan harmonis, berlandaskan kearifan lokal serta inovasi demi
                kesejahteraan masyarakat</p>
            <!-- Container untuk tombol dengan flexbox -->
            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center align-items-center reveal">
                <a href="#potensi" class="shadow-sm btn btn-primary btn-lg rounded-pill">
                    <i class="fas fa-compass me-2"></i>Jelajahi Desa
                </a>
                <a href="#" class="shadow-sm btn btn-success btn-lg rounded-pill download-app-btn"
                    data-bs-toggle="modal" data-bs-target="#downloadModal">
                    <i class="fab fa-android me-2"></i>Download Aplikasi
                </a>
            </div>
        </div>
    </section>

    <!-- Bagian Tentang Kami -->
    <section id="tentang" class="py-5 my-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal">
                    <img src="{{ asset('landing/assets/img/ProfilDesa.jpg') }}" alt="Tentang Desa"
                        class="shadow-sm img-fluid rounded-4">
                </div>
                <div class="col-lg-6 reveal">
                    <h2 class="text-center section-title text-lg-start">Tentang Desa Akat Fadedo</h2>
                    <h5 class="text-center fw-bold text-lg-start">Visi Desa</h5>
                    <p class="mb-4 text-justify-custom">Terwujudnya Masyarakat Desa Akat Fadedo yang Religius, Cerdas, Maju,
                        Sehat Dan
                        Sejahtera.</p>
                    <h5 class="text-center fw-bold text-lg-start">Sejarah Desa</h5>
                    <p class="card-text text-justify-custom">Akat Fadedo sudah ada sejak jaman dulu namun penghuni pertama
                        hanya 4 keluarga dan
                        Fadedo masih kategori dusun dari Negeri Urung. (Anak Dusun Desa Urung).<br>
                        Seiring dengan perkembangan zaman pertumbuhan penduduk pun mulai bertambah. setelah Seram Bagian
                        Timur mekar dari Maluku Tengah pada tahun 2003 Pemerintah SBT mulai melakukan pemekaran Kecematan
                        dari 5 Kecamatan menjadi 15 Kecematan, dusun dusun di SBT pun ambil bagian di pemekaran tersebetu
                        salah satunya dusun Akat Fadedo yang di mekarkan pada tahun 2014 menjadi sebuah Desa Administratif.
                        <br>
                        Dan sampai saat ini Desa Administratif Akat Fadedo telah di pimpin oleh 3 Pejabat Kepala Pemerintah.
                    </p>
                    <a href="#" class="mt-4 shadow-sm btn btn-primary rounded-pill">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Lokasi Desa -->
    <section id="lokasi-desa" class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="text-center section-title">Peta & Wilayah Desa</h2>
            <div class="row g-4 reveal">
                <div class="col-lg-6">
                    <!-- Embed Google Maps -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1442.3112557462064!2d130.71061032854638!3d-3.8241932616395586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d40810037fec673%3A0x4407ad62fb3b89d6!2sKantor%20Desa%20Akat%20Fadedo!5e1!3m2!1sid!2sid!4v1738774423050!5m2!1sid!2sid"
                        class="shadow-sm img-fluid rounded-4 w-100 h-100" style="border:0;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="col-lg-6">
                    <h5 class="mb-3 fw-bold text-muted">Informasi Geografis</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 lead"><i class="fas fa-map-marked-alt me-2 text-info"></i> Luas Wilayah:
                            **15.000 km²**</li>
                        <li class="mb-2 lead fw-bold text-muted"><i class="fas fa-border-all me-2 text-info"></i> Batas
                            Wilayah:
                        </li>
                        <ul class="list-unstyled ms-4">
                            <li class="text-muted"><i class="fas fa-arrow-up me-2 text-info"></i> Utara: Berbatasan dengan
                                Gunung Teri</li>
                            <li class="text-muted"><i class="fas fa-arrow-down me-2 text-info"></i> Selatan: Berbatasan
                                dengan Laut Banda</li>
                            <li class="text-muted"><i class="fas fa-arrow-right me-2 text-info"></i> Timur: Berbatasan
                                dengan Desa Mugusinis</li>
                            <li class="text-muted"><i class="fas fa-arrow-left me-2 text-info"></i> Barat: Berbatasan
                                dengan Desa Sumbawa</li>
                        </ul>
                    </ul>
                    <h5 class="mt-4 mb-3 fw-bold">Kondisi Topografi</h5>
                    <p class="card-text text-muted text-justify-custom">Desa Maju memiliki topografi yang bervariasi,
                        didominasi oleh dataran
                        rendah dan perbukitan yang subur, ideal untuk pertanian dan perkebunan. Ketinggiannya berkisar
                        antara 100 hingga 300 meter di atas permukaan laut.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Bagian Statistik -->
    <section id="statistik" class="py-5 my-5">
        <div class="container">
            <h2 class="text-center section-title">Statistik Desa</h2>
            <div class="text-center row g-4 justify-content-center">
                <!-- Statistik 1: Total Penduduk -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-users fa-3x text-primary"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ number_format($jumlahPenduduk) }}</h3>
                            <p class="card-text text-muted">Total Penduduk</p>
                        </div>
                    </div>
                </div>

                <!-- Statistik 2: Kepala Keluarga -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-house-user fa-3x text-success"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ number_format($jumlahKk) }}</h3>
                            <p class="card-text text-muted">Kepala Keluarga</p>
                        </div>
                    </div>
                </div>

                <!-- Statistik 3: Laki-laki -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-male fa-3x text-info"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ number_format($jumlahLakiLaki) }}</h3>
                            <p class="card-text text-muted">Laki-laki</p>
                        </div>
                    </div>
                </div>

                <!-- Statistik 4: Perempuan -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-female fa-3x text-warning"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ number_format($jumlahPerempuan) }}</h3>
                            <p class="card-text text-muted">Perempuan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Selengkapnya untuk Statistik -->
            <div class="mt-5 text-center reveal">
                <a href="{{ route('home.profil-desa') }}" class="px-4 btn btn-outline-primary rounded-pill">
                    <i class="fas fa-chart-bar me-2"></i>Lihat Statistik Lengkap
                </a>
            </div>
        </div>
    </section>

    <!-- Bagian Transparansi APBDes -->
    <section id="transparansi" class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="text-center section-title">Transparansi APBDes</h2>
            <div class="text-center row g-4 justify-content-center reveal">
                <div class="col-12 col-md-8 col-lg-6 d-flex">
                    <div class="p-4 shadow-sm border-1 card w-100">
                        <div class="mb-4 d-flex align-items-center">
                            <div class="p-3 me-4 bg-info bg-opacity-10 d-inline-block">
                                <i class="fas fa-file-invoice fa-2x text-info"></i>
                            </div>
                            <div>
                                @if ($apbdes)
                                    <h5 class="mb-1 fw-bold">APBDes Tahun {{ $apbdes->tahun }}</h5>
                                    <p class="mb-0 h3 fw-bold text-info">
                                        Total Anggaran: Rp {{ number_format($apbdes->pendapatan, 0, ',', '.') }}
                                    </p>
                                @else
                                    <p class="text-muted">Data APBDes belum tersedia.</p>
                                @endif
                            </div>
                        </div>
                        <p class="card-text text-muted">Informasi ini mencakup rincian alokasi dana untuk pembangunan,
                            pemberdayaan, dan penyelenggaraan pemerintahan desa.</p>
                        <ul class="mb-4 list-unstyled text-start">
                            <li class="mb-1 text-muted"><i class="fas fa-user-tie me-2 text-info"></i> Disahkan oleh:
                                AHMAD BUGIS</li>
                            <li class="text-muted"><i class="far fa-calendar-alt me-2 text-info"></i> Terakhir
                                diperbarui: 2 weeks ago</li>
                        </ul>
                        <a href="#" class="px-4 btn btn-outline-primary rounded-pill align-self-end">Lihat
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Bagian Struktur Pemerintahan Desa -->
<section id="struktur-desa" class="team section py-5 my-5 bg-light">
    <div class="container section-title text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold">Struktur Pemerintahan Desa</h2>
        <p class="text-muted">Susunan kepengurusan desa yang bertanggung jawab atas administrasi dan pelayanan masyarakat.</p>
    </div>

    <div class="container">
        <div class="row gy-4 justify-content-center">
            @forelse ($strukturDesa as $anggota)
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch reveal" data-aos="fade-up" data-aos-delay="100">
    <div class="team-member card border-0 shadow-sm rounded-4 w-100 text-center overflow-hidden">
        
        <!-- Foto -->
        <div class="member-img mt-4 position-relative">
            <img src="{{ asset('storage/' . $anggota->image) }}" 
                 alt="{{ $anggota->nama }}" 
                 class="img-fluid rounded-circle shadow-sm"
                 style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #fff;">
        </div>

        <!-- Info Anggota -->
        <div class="member-info card-body">
            <h5 class="fw-bold mb-1 text-dark">{{ $anggota->nama }}</h5>
            <p class="text-muted small mb-3">{{ $anggota->jabatan ?? $anggota->posisi }}</p>

            <!-- Sosial Media -->
            <div class="social mt-3 d-flex justify-content-center gap-2">
                @if ($anggota->twitter)
                    <a href="{{ $anggota->twitter }}" target="_blank" 
                       class="social-icon twitter" title="Twitter/X">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                @endif
                @if ($anggota->facebook)
                    <a href="{{ $anggota->facebook }}" target="_blank" 
                       class="social-icon facebook" title="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                @endif
                @if ($anggota->instagram)
                    <a href="{{ $anggota->instagram }}" target="_blank" 
                       class="social-icon instagram" title="Instagram">
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

        <!-- Tombol Selengkapnya -->
        <div class="text-center mt-5 reveal">
            <a href="{{ route('home.daftar-sturktur-desa') }}" 
               class="px-4 btn btn-outline-primary rounded-pill">
                <i class="fas fa-sitemap me-1"></i> Lihat Struktur Desa Lebih Banyak
            </a>
        </div>
    </div>
</section>

    <!-- Bagian Layanan -->
    <section id="layanan" class="py-5 my-5">
        <div class="container">
            <h2 class="text-center section-title">Layanan Desa</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-clipboard-list fa-3x text-info"></i>
                            <h3 class="mb-2 card-title h4">Layanan Administrasi</h3>
                            <p class="card-text text-muted">Masyarakat dapat mengajukan pembuatan berbagai surat seperti
                                surat keterangan domisili,
                                surat
                                izin usaha, dan surat pengantar lainnya secara online.</p>
                            <a href="#" class="mt-3 btn btn-sm btn-primary rounded-pill">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-handshake fa-3x text-info"></i>
                            <h3 class="mb-2 card-title h4">Pengaduan Masyarakat</h3>
                            <p class="card-text text-muted">Masyarakat dapat melaporkan keluhan atau permasalahan terkait
                                infrastruktur, keamanan, dan
                                layanan
                                publik di desa.</p>
                            <a href="#" class="mt-3 btn btn-sm btn-primary rounded-pill">Selengkapnya</a>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal modal-lg fade" id="requirementModal" tabindex="-1"
                        aria-labelledby="requirementModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content border-2">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <!-- Kiri -->
                                        <div class="col-md-6 text-light p-3 rounded"
                                            style="background: url('{{ asset('images/background2.png') }}') no-repeat center center;
                                                    background-size: cover; position: relative; overflow: hidden;">
                                            background-size: cover; position: relative; overflow: hidden;">

                                            <div class="row position-relative" style="z-index: 2;">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div class="me-4">
                                                        <img src="{{ asset('images/logo.png') }}" alt="Logo"
                                                            class="img-fluid" style="max-width: 100px;">
                                                    </div>
                                                    <div style="text-align: justify;">
                                                        <p class="mb-1">Layanan Desa</p>
                                                        <p class="mb-1">Local Class Tech</p>
                                                        <p class="mb-0">Version: 1.0</p>
                                                    </div>
                                                </div>

                                                <!-- Preview Images -->
                                                <div class="bg-light rounded my-3 px-2 py-3 text-center"
                                                    style="width: calc(100% - 10px); margin: auto;">
                                                    <div class="d-flex justify-content-center gap-3 flex-nowrap"
                                                        style="overflow-x: auto;">
                                                        <img src="{{ asset('images/preview1.png') }}" alt="Preview 1"
                                                            style="width: 90px;">
                                                        <img src="{{ asset('images/preview2.png') }}" alt="Preview 2"
                                                            style="width: 90px;">
                                                        <img src="{{ asset('images/preview3.png') }}" alt="Preview 3"
                                                            style="width: 90px;">
                                                    </div>
                                                </div>

                                                <div class="mt-2 mb-2 text-center">
                                                    <a href="{{ asset('apk/layanan-desa-v1.apk') }}" download>
                                                        <button type="button" class="btn text-white fw-bold"
                                                            style="background-color: #1ABAFF; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 180px;"
                                                            onmouseover="this.style.backgroundColor='#004F71'; this.style.border=' 1px solid #ffffff';"
                                                            onmouseout="this.style.backgroundColor='#1ABAFF'; this.style.border=' 1px solid #0071A5'">
                                                            Download
                                                        </button>
                                                    </a>

                                                    <a href="{{ asset('apk/layanan-desa-v1.apk') }}" download>
                                                        <button type="button" class="btn text-white fw-bold"
                                                            style="background-color: #1ABAFF; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 180px;"
                                                            onmouseover="this.style.backgroundColor='#004F71'; this.style.border=' 1px solid #ffffff';"
                                                            onmouseout="this.style.backgroundColor='#1ABAFF'; this.style.border=' 1px solid #0071A5'">
                                                            Download
                                                        </button>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Kanan -->
                                        <div class="col-md-6 text-light pt-2 px-3" style="text-align: justify">
                                            <h5 style="color: #4A4A4A"><strong>Layanan Desa</strong></h5>
                                            <p style="font-size: 14px; color: #4A4A4A;">
                                                Mau ajukan surat, baca berita desa, cek APBDes, atau lapor keluhan?
                                                Semua bisa lewat aplikasi Layanan Desa. Yuk, unduh sekarang dan rasakan
                                                mudahnya layanan desa digital!
                                            </p>
                                            <h5 style="color: #4A4A4A"><strong>Tujuan Kami</strong></h5>
                                            <ol style="font-size: 14px; color: #4A4A4A">
                                                <li>Meningkatkan pelayanan publik desa melalui teknologi</li>
                                                <li>Mempermudah akses masyarakat terhadap layanan administrasi seperti
                                                    Pengaduan Surat, Transparansi APBDes, dan informasi desa</li>
                                                <li>Mendukung program digitalisasi desa yang transparan dan akuntabel.</li>
                                            </ol>
                                            <h6 class="mt-3" style="font-size: 14px; color: #4A4A4A"><strong>Desa Akad
                                                    Fadedo - Melayani dengan Teknologi, Membangun dengan Hati.</strong></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bagian UMKM -->
    <section id="umkm" class="py-5 my-5">
        <div class="container">
            <h2 class="text-center section-title">UMKM Desa</h2>
            <p class="text-center text-muted mb-5">Produk unggulan dan usaha kreatif masyarakat Desa Akat Fadedo</p>

            @if ($umkm->isEmpty())
                <p class="text-center text-muted">Data UMKM belum tersedia.</p>
            @else
                <div class="row g-4">
                    @foreach ($umkm as $item)
                        <div class="col-lg-4 col-md-6 d-flex reveal">
                            <div class="shadow-sm card card-layanan w-100">
                                <img src="{{ asset('storage/' . $item->foto_produk) }}" class="card-img-top"
                                    alt="{{ $item->nama_produk }}" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-info">{{ $item->kategori_label }}</span>
                                        <small class="text-muted">{{ $item->penduduk->nama_lengkap ?? 'N/A' }}</small>
                                    </div>
                                    <h5 class="card-title">{{ $item->nama_usaha }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $item->nama_produk }}</h6>
                                    <p class="card-text">{{ Str::limit($item->deskripsi_produk, 80) }}</p>
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
                    @endforeach
                </div>
            @endif

            <!-- Tombol Selengkapnya untuk UMKM -->
            <div class="mt-5 text-center reveal">
                <a href="{{ route('umkm.public.index') }}" class="px-4 btn btn-outline-primary rounded-pill">
                    <i class="fas fa-store me-2"></i>Lihat Semua UMKM
                </a>
            </div>
        </div>
    </section>

   <!-- Bagian Galeri Foto -->
<section id="galeri" class="py-5 my-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-4 section-title">Galeri Foto</h2>

        @if ($galeri->isEmpty())
            <p class="text-center text-muted">Galeri foto belum tersedia.</p>
        @else
            <div class="masonry-grid">
                @foreach ($galeri as $item)
                    <div class="masonry-item">
                        <div class="card galeri-card border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $item->image) }}"
                                 alt="{{ $item->nama_kegiatan }}"
                                 class="galeri-img img-gallery"
                                 data-bs-toggle="modal"
                                 data-bs-target="#galleryModal"
                                 data-img-src="{{ asset('storage/' . $item->image) }}"
                                 data-title="{{ $item->nama_kegiatan }}">
                            <div class="p-2 text-center">
                                <h6 class="fw-semibold mt-2 mb-0">{{ $item->nama_kegiatan }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Tombol Selengkapnya -->
        <div class="mt-5 text-center reveal">
            <a href="{{ route('home.daftar-galeri') }}" 
               class="px-4 btn btn-outline-primary rounded-pill">
                <i class="fas fa-images me-1"></i> Lihat Semua Galeri
            </a>
        </div>
    </div>
</section>

<!-- Modal Galeri -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark text-white border-0 rounded-4 overflow-hidden shadow-lg">
            <div class="modal-body p-0 position-relative">
                <!-- Gambar -->
                <img id="modalImage" src="" alt="Gambar Galeri"
                     class="img-fluid w-100 d-block animate__animated animate__zoomIn">

                <!-- Caption -->
                <div class="p-3 bg-dark bg-opacity-75 position-absolute bottom-0 start-0 w-100">
                    <h5 id="modalTitle" class="mb-0 fw-semibold text-center"></h5>
                </div>

                <!-- Tombol Tutup -->
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                        data-bs-dismiss="modal" aria-label="Close"></button>

                <!-- Navigasi -->
                <button class="btn btn-dark btn-lg position-absolute top-50 start-0 translate-middle-y"
                        id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                <button class="btn btn-dark btn-lg position-absolute top-50 end-0 translate-middle-y"
                        id="nextBtn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</div>


    <!-- Bagian Berita -->
    <section id="berita" class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="text-center section-title">Berita Terbaru</h2>
            @if ($berita->isEmpty())
                <p class="text-center text-muted">Berita belum tersedia.</p>
            @else
                <div class="row g-4">
    @foreach ($berita as $item)
        @php
            $katKey = strtolower(trim($item->kategori));
            $kat = $kategoriData[$katKey] ?? null;
        @endphp

        <div class="col-lg-4 col-md-6 d-flex reveal">
            <a href="{{ route('berita.show', $item->slug) }}" style="text-decoration: none; color: inherit;">
                <div class="shadow-sm card card-berita w-100 h-100">
                    {{-- Gambar --}}
                    <img src="{{ asset('storage/' . $item->gambar) }}" 
                         class="card-img-top" alt="{{ $item->judul }}"
                         style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        {{-- Judul --}}
                        <h5 class="card-title fw-bold">{{ Str::limit($item->judul, 60) }}</h5>

                        {{-- Meta info --}}
                        <p class="card-text text-muted small mb-2">
                            <i class="far fa-calendar-alt me-2"></i>
                            {{ $item->created_at->format('d F Y') }}
                        </p>

                        {{-- Badge Kategori --}}
                        @if ($kat)
                            <span class="badge {{ $kat['class'] }} px-3 py-2 shadow-sm mb-2">
                                <i class="{{ $kat['icon'] }} me-1"></i> {{ $kat['nama'] }}
                            </span>
                        @else
                            <span class="badge bg-secondary text-white px-3 py-2 shadow-sm mb-2">
                                <i class="fas fa-tag me-1"></i> {{ ucfirst($item->kategori) }}
                            </span>
                        @endif

                        {{-- Ringkasan --}}
                        <p class="card-text">{{ Str::limit(strip_tags($item->konten), 100) }}</p>

                        {{-- Tombol --}}
                        <a href="{{ route('berita.show', $item->slug) }}"
                           class="btn btn-sm btn-primary rounded-pill mt-auto">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>


            @endif
            <!-- Tombol Selengkapnya untuk Berita -->
            <div class="mt-5 text-center reveal">
            <a href="{{ route('home.daftar-berita') }}" 
               class="px-4 btn btn-outline-primary rounded-pill">
                 <i class="fas fa-book-open me-2"></i>  Lihat Semua Berita
            </a>
        </div>
        </div>
    </section>

    

    <!-- Bagian Kontak -->
    <section id="kontak" class="py-5 text-white bg-dark">
        <div class="container">
            <h2 class="text-center text-white section-title">Hubungi Kami</h2>
            <div class="row g-4 reveal">
                <div class="text-center col-12">
                    <h5 class="fw-bold">Informasi Kontak</h5>
                    <p class="text-white"><i class="fas fa-map-marker-alt me-2 text-info"></i> Jalan Desa No. 123,
                        Kecamatan, Kabupaten, Provinsi</p>
                    <p class="text-white"><i class="fas fa-envelope me-2 text-info"></i> info@desamaju.go.id</p>
                    <p class="text-white"><i class="fas fa-phone-alt me-2 text-info"></i> (021) 123-4567</p>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Styles Galeri --}}
@push('styles')
<style>
    /* Masonry grid ala Pinterest */
    .masonry-grid {
        column-count: 4;
        column-gap: 1rem;
    }
    .masonry-item {
        break-inside: avoid;
        margin-bottom: 1rem;
    }
    @media (max-width: 1200px) { .masonry-grid { column-count: 3; } }
    @media (max-width: 768px) { .masonry-grid { column-count: 2; } }
    @media (max-width: 576px) { .masonry-grid { column-count: 1; } }

    /* Card galeri */
    .galeri-card {
        overflow: hidden;
        border-radius: 12px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    .galeri-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .galeri-img {
        width: 100%;
        border-radius: 12px 12px 0 0;
        display: block;
        transition: transform 0.4s ease;
    }
    .galeri-card:hover .galeri-img {
        transform: scale(1.05);
    }

    /* Modal */
    #galleryModal .btn {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    #galleryModal .btn:hover { opacity: 1; }
    #modalImage {
        max-height: 80vh;
        object-fit: contain;
    }
    /* Fade Animations */
    .fade-out {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .fade-in {
        opacity: 1;
        transition: opacity 0.4s ease;
    }
     /* Batasi ukuran modal agar lebih kecil dari layar penuh */
    #galleryModal .modal-dialog {
        max-width: 900px; /* default xl terlalu besar, kita perkecil */
    }

    @media (max-width: 992px) {
        #galleryModal .modal-dialog {
            max-width: 720px; /* untuk tablet */
        }
    }

    @media (max-width: 768px) {
        #galleryModal .modal-dialog {
            max-width: 95%; /* hampir full di hp */
        }
    }

    #modalImage {
        max-height: 70vh;   /* biar nggak menutupi layar penuh */
        object-fit: contain;
    }
</style>
@endpush

{{-- Scripts Galeri --}}

@push('scripts')
<script>
    const galleryItems = document.querySelectorAll('.img-gallery');
    const modalImage   = document.getElementById('modalImage');
    const modalTitle   = document.getElementById('modalTitle');
    let currentIndex   = 0;

    function showImage(index) {
        const img = galleryItems[index];
        if (!img) return;

        // Tambah animasi fade-out
        modalImage.classList.add('fade-out');

        setTimeout(() => {
            modalImage.src = img.dataset.imgSrc;
            modalTitle.textContent = img.dataset.title || 'Galeri';

            // Setelah gambar diganti → fade-in
            modalImage.classList.remove('fade-out');
            modalImage.classList.add('fade-in');

            // Reset animasi setelah selesai
            setTimeout(() => modalImage.classList.remove('fade-in'), 400);

            currentIndex = index;
        }, 300); // delay harus sama dengan durasi animasi fade-out
    }

    // Klik item galeri → tampilkan modal
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => showImage(index));
    });

    // Navigasi kiri/kanan
    document.getElementById('prevBtn').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
        showImage(currentIndex);
    });
    document.getElementById('nextBtn').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % galleryItems.length;
        showImage(currentIndex);
    });

    // Scroll reveal
    const revealElements = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });

    revealElements.forEach(el => observer.observe(el));
</script>
@endpush

{{-- script Sturuktur Desa --}}
@push('styles')
<style>
    /* Card Struktur Desa */
.team-member {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background: #fff;
}
.team-member:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15);
}

/* Foto */
.team-member .member-img img {
    transition: transform 0.4s ease, border-color 0.3s ease;
}
.team-member:hover .member-img img {
    transform: scale(1.05);
    border-color: #0d6efd;
}

/* Nama & Jabatan */
.team-member .member-info h5 {
    font-size: 1.1rem;
}
.team-member .member-info p {
    font-size: 0.9rem;
}

/* Sosial Media Ikon */
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
.social-icon.twitter { background: #000; }
.social-icon.facebook { background: #1877F2; }
.social-icon.instagram { 
    background: radial-gradient(circle at 30% 30%, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5); 
}
.social-icon:hover {
    transform: scale(1.15);
    box-shadow: 0 6px 15px rgba(0,0,0,0.25);
}

</style>
@endpush

