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
            <h1 class="display-3 fw-bold mb-4 reveal">Selamat Datang di Desa Akat Fadedo</h1>
            <p class="lead mb-5 reveal">Membangun desa yang maju dan harmonis, berlandaskan kearifan lokal serta inovasi demi
                kesejahteraan masyarakat</p>
            <a href="#potensi" class="btn btn-primary btn-lg rounded-pill shadow-sm reveal">Jelajahi Desa</a>
        </div>
    </section>

    <!-- Bagian Tentang Kami -->
    <section id="tentang" class="py-5 my-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal">
                    <img src="{{ asset('landing/assets/img/ProfilDesa.jpg') }}" alt="Tentang Desa"
                        class="img-fluid rounded-4 shadow-sm">
                </div>
                <div class="col-lg-6 reveal">
                    <h2 class="section-title text-center text-lg-start">Tentang Desa Akat Fadedo</h2>
                    <h5 class="fw-bold text-center text-lg-start">Visi Desa</h5>
                    <p class="lead mb-4">Terwujudnya Masyarakat Desa Akat Fadedo yang Religius, Cerdas, Maju, Sehat Dan
                        Sejahtera.</p>
                    <h5 class="fw-bold text-center text-lg-start">Sejarah Desa</h5>
                    <p class="card-text">Akat Fadedo sudah ada sejak jaman dulu namun penghuni pertama hanya 4 keluarga dan
                        Fadedo masih kategori dusun dari Negeri Urung. (Anak Dusun Desa Urung).<br>
                        Seiring dengan perkembangan zaman pertumbuhan penduduk pun mulai bertambah. setelah Seram Bagian
                        Timur mekar dari Maluku Tengah pada tahun 2003 Pemerintah SBT mulai melakukan pemekaran Kecematan
                        dari 5 Kecamatan menjadi 15 Kecematan, dusun dusun di SBT pun ambil bagian di pemekaran tersebetu
                        salah satunya dusun Akat Fadedo yang di mekarkan pada tahun 2014 menjadi sebuah Desa Administratif.
                        <br>
                        Dan sampai saat ini Desa Administratif Akat Fadedo telah di pimpin oleh 3 Pejabat Kepala Pemerintah.
                    </p>
                    <a href="#" class="btn btn-primary rounded-pill mt-4 shadow-sm">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Lokasi Desa -->
    <section id="lokasi-desa" class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="section-title text-center">Peta & Wilayah Desa</h2>
            <div class="row g-4 reveal">
                <div class="col-lg-6">
                    <!-- Embed Google Maps -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1442.3112557462064!2d130.71061032854638!3d-3.8241932616395586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d40810037fec673%3A0x4407ad62fb3b89d6!2sKantor%20Desa%20Akat%20Fadedo!5e1!3m2!1sid!2sid!4v1738774423050!5m2!1sid!2sid"
                        class="img-fluid rounded-4 shadow-sm w-100 h-100" style="border:0;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="col-lg-6">
                    <h5 class="fw-bold mb-3 text-muted">Informasi Geografis</h5>
                    <ul class="list-unstyled">
                        <li class="lead mb-2"><i class="fas fa-map-marked-alt me-2 text-info"></i> Luas Wilayah:
                            **15.000 km²**</li>
                        <li class="lead mb-2 fw-bold text-muted"><i class="fas fa-border-all me-2 text-info"></i> Batas
                            Wilayah:
                        </li>
                        <ul class="list-unstyled ms-4">
                            <li class="text-muted"><i class="fas fa-arrow-up me-2 text-info"></i> Utara: Desa A</li>
                            <li class="text-muted"><i class="fas fa-arrow-down me-2 text-info"></i> Selatan: Desa B</li>
                            <li class="text-muted"><i class="fas fa-arrow-right me-2 text-info"></i> Timur: Gunung C</li>
                            <li class="text-muted"><i class="fas fa-arrow-left me-2 text-info"></i> Barat: Sungai D</li>
                        </ul>
                    </ul>
                    <h5 class="fw-bold mt-4 mb-3">Kondisi Topografi</h5>
                    <p class="card-text text-muted">Desa Maju memiliki topografi yang bervariasi, didominasi oleh dataran
                        rendah dan perbukitan yang subur, ideal untuk pertanian dan perkebunan. Ketinggiannya berkisar
                        antara 100 hingga 300 meter di atas permukaan laut.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Bagian Statistik -->
    <section id="statistik" class="py-5 my-5">
        <div class="container">
            <h2 class="section-title text-center">Statistik Desa</h2>
            <div class="row g-4 text-center justify-content-center">
                <!-- Statistik 1: Populasi -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="card card-statistik p-4 w-100">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x text-info mb-3"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ number_format($jumlahPenduduk) }}</h3>
                            <p class="card-text text-muted">Penduduk</p>
                        </div>
                    </div>
                </div>
                <!-- Statistik 2: Luas Wilayah -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="card card-statistik p-4 w-100">
                        <div class="card-body">
                            <i class="fas fa-seedling fa-3x text-info mb-3"></i>
                            <h3 class="card-title h1 fw-bold text-muted">250 Ha</h3>
                            <p class="card-text text-muted">Lahan Pertanian</p>
                        </div>
                    </div>
                </div>
                <!-- Statistik 3: Rumah Tangga -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="card card-statistik p-4 w-100">
                        <div class="card-body">
                            <i class="fas fa-house-user fa-3x text-info mb-3"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ number_format($jumlahKk) }}</h3>
                            <p class="card-text text-muted">Kepala Keluarga</p>
                        </div>
                    </div>
                </div>
                <!-- Statistik 4: Pendidikan -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="card card-statistik p-4 w-100">
                        <div class="card-body">
                            <i class="fas fa-school fa-3x text-info mb-3"></i>
                            <h3 class="card-title h1 fw-bold text-muted">95%</h3>
                            <p class="card-text text-muted">Angka Melek Huruf</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tombol Selengkapnya untuk Statistik -->
            <div class="text-center mt-5 reveal">
                <a href="#" class="btn btn-outline-primary rounded-pill px-4">Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- Bagian Transparansi APBDes -->
    <section id="transparansi" class="bg-white py-5 my-5">
        <div class="container">
            <h2 class="section-title text-center">Transparansi APBDes</h2>
            <div class="row g-4 justify-content-center text-center reveal">
                <div class="col-12 col-md-8 col-lg-6 d-flex">
                    <div class="card p-4 w-100 shadow-sm border-0">
                        <div class="d-flex align-items-center mb-4">
                            <div class="me-4 p-3 bg-info bg-opacity-10 rounded-circle d-inline-block">
                                <i class="fas fa-file-invoice fa-2x text-info"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">APBDes Tahun 2025</h5>
                                <p class="h3 fw-bold text-info mb-0">Total Anggaran: Rp {{ $apbdes }}</p>
                            </div>
                        </div>
                        <p class="card-text text-muted">Informasi ini mencakup rincian alokasi dana untuk pembangunan,
                            pemberdayaan, dan penyelenggaraan pemerintahan desa.</p>
                        <ul class="list-unstyled text-start mb-4">
                            <li class="text-muted mb-1"><i class="fas fa-user-tie me-2 text-info"></i> Disahkan oleh:
                                AHMAD BUGIS</li>
                            <li class="text-muted"><i class="far fa-calendar-alt me-2 text-info"></i> Terakhir
                                diperbarui: 2 weeks ago</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary rounded-pill align-self-start px-4">Lihat
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Bagian Struktur Organisasi Desa -->
    <section id="organisasi" class="bg-white py-5 my-5">
        <div class="container">
            <h2 class="section-title text-center">Struktur Organisasi Desa</h2>
            @if ($strukturDesa->isEmpty())
                <p class="text-center text-muted">Data struktur organisasi belum tersedia.</p>
            @else
                <div class="row g-4 justify-content-center text-center reveal">
                    @foreach ($strukturDesa as $jabatan)
                        <div class="col-12 col-md-6 col-lg-4 d-flex">
                            <div class="card p-3 shadow-sm w-100 text-center">
                                <img src="{{ asset('storage/' . $jabatan->foto) }}" alt="{{ $jabatan->jabatan }}"
                                    class="img-fluid rounded-circle mb-3 mx-auto"
                                    style="width: 200px; height: 200px; object-fit: cover;">
                                <h5 class="fw-bold mb-1">{{ $jabatan->jabatan }}</h5>
                                <p class="text-muted mb-0">{{ $jabatan->nama }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Tombol Selengkapnya untuk Struktur Organisasi -->
            <div class="text-center mt-5 reveal">
                <a href="#" class="btn btn-outline-primary rounded-pill px-4">Selengkapnya</a>
            </div>
        </div>
    </section>


    <!-- Bagian Layanan -->
    <section id="layanan" class="py-5 my-5">
        <div class="container">
            <h2 class="section-title text-center">Layanan Desa</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4 d-flex reveal">
                    <div class="card card-layanan text-center p-3 w-100">
                        <div class="card-body">
                            <i class="fas fa-clipboard-list fa-3x text-info mb-3"></i>
                            <h3 class="card-title h4 mb-2">Layanan Administrasi</h3>
                            <p class="card-text text-muted">Masyarakat dapat mengajukan pembuatan berbagai surat seperti
                                surat keterangan domisili,
                                surat
                                izin usaha, dan surat pengantar lainnya secara online.</p>
                            <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-flex reveal">
                    <div class="card card-layanan text-center p-3 w-100">
                        <div class="card-body">
                            <i class="fas fa-handshake fa-3x text-info mb-3"></i>
                            <h3 class="card-title h4 mb-2">Pengaduan Masyarakat</h3>
                            <p class="card-text text-muted">Masyarakat dapat melaporkan keluhan atau permasalahan terkait
                                infrastruktur, keamanan, dan
                                layanan
                                publik di desa.</p>
                            <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 d-flex reveal">
                    <div class="card card-layanan text-center p-3 w-100">
                        <div class="card-body">
                            <i class="fas fa-info-circle fa-3x text-info mb-3"></i>
                            <h3 class="card-title h4 mb-2">Pusat Informasi Wisata</h3>
                            <p class="card-text text-muted">Dapatkan informasi lengkap tentang destinasi wisata,
                                akomodasi, dan panduan perjalanan di Desa Maju.</p>
                            <a href="#" class="btn btn-sm btn-primary rounded-pill mt-3">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Galeri Foto -->
    <section id="galeri" class="py-5 my-5">
        <div class="container">
            <h2 class="section-title text-center">Galeri Foto</h2>
            @if ($galeri->isEmpty())
                <p class="text-center text-muted">Galeri foto belum tersedia.</p>
            @else
                <div class="row g-4">
                    @foreach ($galeri as $item)
                        <!-- Gambar Galeri -->
                        <div class="col-6 col-md-4 col-lg-3 reveal">
                            <a href="#" class="d-block img-gallery" data-bs-toggle="modal"
                                data-bs-target="#galleryModal" data-img-src="{{ asset('storage/' . $item->foto) }}">
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->caption }}"
                                    class="img-fluid w-100">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Tombol Selengkapnya untuk Potensi -->
            <div class="text-center mt-5 reveal">
                <a href="#" class="btn btn-primary rounded-pill px-4 shadow-sm">Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- Bagian Berita -->
    <section id="berita" class="bg-white py-5 my-5">
        <div class="container">
            <h2 class="section-title text-center">Berita Terbaru</h2>
            @if ($berita->isEmpty())
                <p class="text-center text-muted">Berita belum tersedia.</p>
            @else
                <div class="row g-4">
                    @foreach ($berita as $item)
                        <div class="col-lg-4 col-md-6 d-flex reveal">
                            <div class="card card-berita w-100 shadow-sm">
                                <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top"
                                    alt="{{ $item->judul }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->judul }}</h5>
                                    <p class="card-text text-muted small"><i class="far fa-calendar-alt me-2"></i>
                                        {{ $item->created_at->format('d F Y') }}</p>
                                    <p class="card-text">{{ Str::limit(strip_tags($item->konten), 100) }}</p>
                                    <a href="{{ route('berita.show', $item->slug) }}"
                                        class="btn btn-sm btn-primary rounded-pill">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Tombol Selengkapnya untuk Berita -->
            <div class="text-center mt-5 reveal">
                <a href="#" class="btn btn-outline-primary rounded-pill px-4">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Modal Galeri -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 bg-transparent">
                <div class="modal-body p-0">
                    <img id="modalImage" src="" alt="Gambar Galeri" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Kontak -->
    <section id="kontak" class="bg-dark text-white py-5">
        <div class="container">
            <h2 class="section-title text-center text-white">Hubungi Kami</h2>
            <div class="row g-4 reveal">
                <div class="col-12 text-center">
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

@push('scripts')
    <script>
        // Logika untuk menampilkan gambar di modal galeri
        const galleryModal = document.getElementById('galleryModal');
        galleryModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const imgSrc = button.getAttribute('data-img-src');
            const modalImage = galleryModal.querySelector('#modalImage');
            modalImage.src = imgSrc;
        });

        // Logika untuk animasi scroll-reveal
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
