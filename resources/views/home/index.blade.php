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
            <h1 class="mb-4 display-3 fw-bold reveal">Selamat Datang di Desa Akat Fadedo</h1>
            <p class="mb-5 lead reveal">Membangun desa yang maju dan harmonis, berlandaskan kearifan lokal serta inovasi demi
                kesejahteraan masyarakat</p>
            <a href="#potensi" class="shadow-sm btn btn-primary btn-lg rounded-pill reveal">Jelajahi Desa</a>
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
                    <p class="mb-4 text-justify-custom">Terwujudnya Masyarakat Desa Akat Fadedo yang Religius, Cerdas, Maju, Sehat Dan
                        Sejahtera.</p>
                    <h5 class="text-center fw-bold text-lg-start">Sejarah Desa</h5>
                    <p class="card-text text-justify-custom">Akat Fadedo sudah ada sejak jaman dulu namun penghuni pertama hanya 4 keluarga dan
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
                            <li class="text-muted"><i class="fas fa-arrow-up me-2 text-info"></i> Utara: Berbatasan dengan Gunung Teri</li>
                            <li class="text-muted"><i class="fas fa-arrow-down me-2 text-info"></i> Selatan: Berbatasan dengan Laut Banda</li>
                            <li class="text-muted"><i class="fas fa-arrow-right me-2 text-info"></i> Timur: Berbatasan dengan Desa Mugusinis</li>
                            <li class="text-muted"><i class="fas fa-arrow-left me-2 text-info"></i> Barat: Berbatasan dengan Desa Sumbawa</li>
                        </ul>
                    </ul>
                    <h5 class="mt-4 mb-3 fw-bold">Kondisi Topografi</h5>
                    <p class="card-text text-muted text-justify-custom">Desa Maju memiliki topografi yang bervariasi, didominasi oleh dataran
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
                <!-- Statistik 1: Populasi -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-users fa-3x text-info"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ number_format($jumlahPenduduk) }}</h3>
                            <p class="card-text text-muted">Penduduk</p>
                        </div>
                    </div>
                </div>
                <!-- Statistik 2: Luas Wilayah -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-seedling fa-3x text-info"></i>
                            <h3 class="card-title h1 fw-bold text-muted">250 Ha</h3>
                            <p class="card-text text-muted">Lahan Pertanian</p>
                        </div>
                    </div>
                </div>
                <!-- Statistik 3: Rumah Tangga -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-house-user fa-3x text-info"></i>
                            <h3 class="card-title h1 fw-bold text-muted">{{ number_format($jumlahKk) }}</h3>
                            <p class="card-text text-muted">Kepala Keluarga</p>
                        </div>
                    </div>
                </div>
                <!-- Statistik 4: Pendidikan -->
                <div class="col-md-6 col-lg-3 d-flex reveal">
                    <div class="p-4 card card-statistik w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-school fa-3x text-info"></i>
                            <h3 class="card-title h1 fw-bold text-muted">95%</h3>
                            <p class="card-text text-muted">Angka Melek Huruf</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tombol Selengkapnya untuk Statistik -->
            <div class="mt-5 text-center reveal">
                <a href="#" class="px-4 btn btn-outline-primary rounded-pill">Selengkapnya</a>
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
                                @if($apbdes)
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


    <!-- Bagian Struktur Organisasi Desa -->
    <section id="organisasi" class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="text-center section-title">Struktur Organisasi Desa</h2>
            @if ($strukturDesa->isEmpty())
                <p class="text-center text-muted">Data struktur organisasi belum tersedia.</p>
            @else
                <div class="text-center row g-4 justify-content-center reveal">
                    @foreach ($strukturDesa as $jabatan)
                        <div class="col-12 col-md-6 col-lg-4 d-flex">
                            <div class="p-3 text-center shadow-sm card w-100">
                                <img src="{{ asset('storage/' . $jabatan->foto) }}" alt="{{ $jabatan->jabatan }}"
                                    class="mx-auto mb-3 img-fluid rounded-circle"
                                    style="width: 200px; height: 200px; object-fit: cover;">
                                <h5 class="mb-1 fw-bold">{{ $jabatan->jabatan }}</h5>
                                <p class="mb-0 text-muted">{{ $jabatan->nama }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Tombol Selengkapnya untuk Struktur Organisasi -->
            <div class="mt-5 text-center reveal">
                <a href="#" class="px-4 btn btn-outline-primary rounded-pill">Selengkapnya</a>
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
                </div>
                <div class="col-md-6 col-lg-4 d-flex reveal">
                    <div class="p-3 text-center card card-layanan w-100">
                        <div class="card-body">
                            <i class="mb-3 fas fa-info-circle fa-3x text-info"></i>
                            <h3 class="mb-2 card-title h4">Pusat Informasi Wisata</h3>
                            <p class="card-text text-muted">Dapatkan informasi lengkap tentang destinasi wisata,
                                akomodasi, dan panduan perjalanan di Desa Maju.</p>
                            <a href="#" class="mt-3 btn btn-sm btn-primary rounded-pill">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Galeri Foto -->
    <section id="galeri" class="py-5 my-5">
        <div class="container">
            <h2 class="text-center section-title">Galeri Foto</h2>
            @if ($galeri->isEmpty())
                <p class="text-center text-muted">Galeri foto belum tersedia.</p>
            @else
                <div class="row g-4">
                    @foreach ($galeri as $item)
                        <!-- Gambar Galeri -->
                        <div class="col-6 col-md-4 col-lg-3 reveal">
                            <a href="#" class="d-block img-gallery" data-bs-toggle="modal"
                                data-bs-target="#galleryModal" data-img-src="{{ asset('storage/' . $item->foto) }}">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->nama_kegiatan }}"
                                class="img-fluid w-100">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- Tombol Selengkapnya untuk Potensi -->
            <div class="mt-5 text-center reveal">
                <a href="#" class="px-4 text-white shadow-sm btn btn-info rounded-pill">Selengkapnya</a>
            </div>
        </div>
    </section>

    <!-- Bagian Berita -->
    <section id="berita" class="py-5 my-5 bg-white">
        <div class="container">
            <h2 class="text-center section-title">Berita Terbaru</h2>
            @if ($berita->isEmpty())
                <p class="text-center text-muted">Berita belum tersedia.</p>
            @else
                <div class="row g-4">
                    @foreach ($berita as $item)
                        <div class="col-lg-4 col-md-6 d-flex reveal">
                            <div class="shadow-sm card card-berita w-100">
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
            <div class="mt-5 text-center reveal">
                <a href="#" class="px-4 btn btn-outline-primary rounded-pill">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Modal Galeri -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="bg-transparent border-0 modal-content">
                <div class="p-0 modal-body">
                    <img id="modalImage" src="" alt="Gambar Galeri" class="shadow-lg img-fluid rounded-4">
                </div>
            </div>
        </div>
    </div>

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
