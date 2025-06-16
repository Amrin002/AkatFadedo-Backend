@extends('layouts.landing')
@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

                <div class="carousel-item active">
                    <img src={{ asset('landing/assets/img/hero-carousel/hero-carousel.jpg') }} alt="">
                    <div class="container">
                        <h2>Selamat Datang di Desa <br /> Akat Fadedo</h2>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> --}}
                        <a href="#about" class="btn-get-started">Jelajahi Desa</a>
                    </div>
                </div><!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src={{ asset('landing/assets/img/hero-carousel/hero-carousel.jpg') }} alt="">
                    <div class="container">
                        <h2>Selamat Datang di Desa <br /> Akat Fadedo</h2>
                        {{-- <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut.</p> --}}
                        <a href="#about" class="btn-get-started">Jelajahi Desa</a>
                    </div>
                </div><!-- End Carousel Item -->

                <div class="carousel-item">
                    <img src={{ asset('landing/assets/img/hero-carousel/hero-carousel.jpg') }} alt="">
                    <div class="container">
                        <h2>Selamat Datang di Desa <br /> Akat Fadedo</h2>
                        {{-- <p>Beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt omnis iste natus error sit voluptatem accusantium.</p> --}}
                        <a href="#about" class="btn-get-started">Jelajahi Desa</a>
                    </div>
                </div><!-- End Carousel Item -->

                {{-- <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>

    <ol class="carousel-indicators"></ol> --}}

            </div>

        </section><!-- /Hero Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fas fa-home icon"></i></div>
                            <h4><a href="" class="stretched-link">Profil Desa</a></h4>
                            <p>Kenali sejarah, visi, dan potensi desa bersama kami. </p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fas fa-info-circle icon"></i></div>
                            <h4><a href="#newspapers" class="stretched-link">Berita Desa</a></h4>
                            <p>Ikuti kabar terbaru dan peristiwa penting di desa. </p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fas fa-users icon"></i></div>
                            <h4><a href="#doctors" class="stretched-link">Struktur Pemerintahan</a></h4>
                            <p>Kenali jajaran pemerintah desa yang melayani warga. </p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fas fa-images icon"></i></div>
                            <h4><a href="#testimonials" class="stretched-link">Galeri Desa</a></h4>
                            <p>Jelajahi koleksi foto dan video terbaik dari desa. </p>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Featured Services Section -->

        <!-- Call To Action Section -->
        {{-- <section id="call-to-action" class="call-to-action section accent-background">

  <div class="container">
    <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
      <div class="col-xl-10">
        <div class="text-center">
          <h3>In an emergency? Need help now?</h3>
          <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          <a class="cta-btn" href="#appointment">Make an Appointment</a>
        </div>
      </div>
    </div>
  </div>

</section><!-- /Call To Action Section --> --}}
        {{-- Profil Desa --}}
        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Profil Desa<br></h2>
                <p>Membangun desa yang maju dan harmonis, berlandaskan kearifan lokal serta inovasi demi kesejahteraan
                    masyarakat</p>
            </div><!-- End Section Title -->
            {{-- Sejarah dan Profil Desa --}}
            <div class="container" data-aos= "fade-up">
                <div class="container ">
                    <div class="row gy-4">
                        <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                            <img src={{ asset('landing/assets/img/ProfilDesa.jpg') }} class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                            <h3>Sejarah dan Profil Desa</h3>
                            <p class="fst-italic" style="text-align: justify">

                                Akat Fadedo sudah ada sejak jaman dulu namun penghuni pertama hanya 4 keluarga dan Fadedo
                                masih
                                kategori dusun dari Negeri Urung. (Anak Dusun Desa Urung).<br>
                                Seiring dengan perkembangan zaman pertumbuhan penduduk pun mulai bertambah. setelah Seram
                                Bagian
                                Timur mekar dari Maluku Tengah pada tahun 2003 Pemerintah SBT mulai melakukan pemekaran
                                Kecematan dari 5 Kecamatan menjadi 15 Kecematan, dusun dusun di SBT pun ambil bagian di
                                pemekaran tersebetu salah satunya dusun Akat Fadedo yang di mekarkan pada tahun 2014 menjadi
                                sebuah Desa Administratif. <br>
                                Dan sampai saat ini Desa Administratif Akat Fadedo telah di pimpin oleh 3 Pejabat Kepala
                                Pemerintah. Atas nama:
                            </p>

                            <ul>
                                <li><i class="bi bi-check2-all"></i> <span>Azis Wokas (2014 - 2020).</span></li>
                                <li><i class="bi bi-check2-all"></i> <span>Muhamat Taher Rumasukun (2021 - 2022).</span>
                                </li>
                                <li><i class="bi bi-check2-all"></i> <span>Ahmad Bugis (2023 - 2025).</span></li>
                            </ul>
                            <p style="text-align: justify">
                                Alhamdulillah saat ini pemekaran hingga sekarang penduduk mulai bertambah (Lihat Statistik
                                Desa). Saat ini Negeri Administratif Akat Fadedo tidak lagi ketinggalan dari desa desa yang
                                ada
                                di SBT.<br>
                                Demikian Sejarah Singkat Negeri Administratif Akat Fadedo
                            </p>
                        </div>
                    </div>
                    <section id="stats" class="stats section">
                        <div class="container" data-aos="fade-up" data-aos-delay="100">
                            <div class="row gy-4">
                                <div class="col-lg-3 col-md-6">
                                    <div class="stats-item d-flex align-items-center w-100 h-100">
                                        <i class="fas fa-users flex-shrink-0"></i>
                                        <div>
                                            <span data-purecounter-start="0" data-purecounter-end="{{ $jumlahPenduduk }}"
                                                data-purecounter-duration="1" class="purecounter"></span>
                                            <p>Jumlah Penduduk</p>
                                        </div>
                                    </div>
                                </div><!-- End Stats Item -->

                                <div class="col-lg-3 col-md-6">
                                    <div class="stats-item d-flex align-items-center w-100 h-100">
                                        <i class="fas fa-school flex-shrink-0"></i>

                                        <div>
                                            <span data-purecounter-start="0"
                                                data-purecounter-end="{{ $fasilitas->fasilitas_pendidikan ?? 0 }}"
                                                data-purecounter-duration="1" class="purecounter"></span>
                                            <p>Jumlah Fasilitas Pendidikan</p>
                                        </div>
                                    </div>
                                </div><!-- End Stats Item -->

                                <div class="col-lg-3 col-md-6">
                                    <div class="stats-item d-flex align-items-center w-100 h-100">
                                        <i class="fas fa-hospital-alt flex-shrink-0"></i>

                                        <div>
                                            <span data-purecounter-start="0"
                                                data-purecounter-end="{{ $fasilitas->fasilitas_kesehatan ?? 0 }}"
                                                data-purecounter-duration="1" class="purecounter"></span>
                                            <p>Jumlah Fasilitas Kesehatan</p>
                                        </div>
                                    </div>
                                </div><!-- End Stats Item -->

                                <div class="col-lg-3 col-md-6">
                                    <div class="stats-item d-flex align-items-center w-100 h-100">
                                        <i class="fas fa-map flex-shrink-0"></i>

                                        <div>
                                            <span data-purecounter-start="0"
                                                data-purecounter-end="{{ $fasilitas->luas_wilayah ?? 0 }}"
                                                data-purecounter-duration="1" class="purecounter"></span>
                                            <p>Luas Wilayah (km²)</p>
                                        </div>
                                    </div>
                                </div><!-- End Stats Item -->
                            </div>
                        </div>
                    </section>
                    <div id="struktur-desa" class="doctors section">
                        <div class="container section-title" data-aos="fade-up">
                            <h2>Struktur Pemerintahan Desa</h2>
                            <p>Susunan kepengurusan desa yang bertanggung jawab atas administrasi dan pelayanan.</p>
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
                                                        <a href="{{ $anggota->twitter }}"><i
                                                                class="bi bi-twitter-x"></i></a>
                                                    @endif
                                                    @if ($anggota->facebook)
                                                        <a href="{{ $anggota->facebook }}"><i
                                                                class="bi bi-facebook"></i></a>
                                                    @endif
                                                    @if ($anggota->instagram)
                                                        <a href="{{ $anggota->instagram }}"><i
                                                                class="bi bi-instagram"></i></a>
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
                                <div class="text-end my-4">
                                    <a href="{{ route('home.daftar-sturktur-desa') }}" class="lihat-berita-link">
                                        <i class="fas fa-file-alt"></i> LIHAT STURKTUR DESA LEBIH BANYAK
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Features Section -->
                    <div id="features" class="features section">

                        <div class="container">

                            <div class="row justify-content-around gy-4">
                                <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img
                                        src={{ asset('images/kantor_desa.png') }} alt=""></div>

                                <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up"
                                    data-aos-delay="200">
                                    <h3>Fasilitas dan Potensi Desa</h3>
                                    <p style="text-align: justify">Desa kami memiliki beragam fasilitas serta potensi
                                        unggulan yang
                                        mendukung kesejahteraan
                                        dan kemajuan masyarakat. Dari sektor pertanian hingga pariwisata, setiap bidang
                                        dikelola
                                        secara berkelanjutan untuk menciptakan desa yang mandiri dan sejahtera.</p>

                                    <div class="icon-box d-flex position-relative" data-aos="fade-up"
                                        data-aos-delay="300">
                                        <i class="fa-solid fa-seedling flex-shrink-0"></i>

                                        <div>
                                            <h4><a href="" class="stretched-link">Pertanian dan Perkebunan</a></h4>
                                            <p style="text-align: justify">Desa memiliki lahan pertanian dan perkebunan
                                                yang subur,
                                                menjadi sumber utama mata
                                                pencaharian masyarakat dan mendukung ketahanan pangan lokal.</p>
                                        </div>
                                    </div><!-- End Icon Box -->

                                    <div class="icon-box d-flex position-relative" data-aos="fade-up"
                                        data-aos-delay="400">
                                        <i class="fa-solid fa-fish flex-shrink-0"></i>

                                        <div>
                                            <h4><a href="" class="stretched-link">Perikanan dan Peternakan</a></h4>
                                            <p style="text-align: justify">Potensi perikanan dan peternakan dikembangkan
                                                melalui
                                                budidaya ikan, ternak sapi,
                                                kambing, dan unggas untuk memenuhi kebutuhan konsumsi serta meningkatkan
                                                ekonomi
                                                warga.
                                            </p>
                                        </div>
                                    </div><!-- End Icon Box -->

                                    <div class="icon-box d-flex position-relative" data-aos="fade-up"
                                        data-aos-delay="500">
                                        <i class="fa-solid fa-store flex-shrink-0"></i>

                                        <div>
                                            <h4><a href="" class="stretched-link">UMKM dan Ekonomi Kreatif</a></h4>
                                            <p style="text-align: justify">Warga desa diberdayakan melalui usaha mikro,
                                                kecil, dan
                                                menengah (UMKM), serta ekonomi
                                                kreatif seperti kerajinan tangan, kuliner, dan produk lokal khas desa.</p>
                                        </div>
                                    </div><!-- End Icon Box -->

                                </div>
                            </div>

                        </div>

                    </div>
        </section><!-- /Features Section -->
        {{-- Tutup Profil Desa --}}
        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan</h2>
                <p>Melayani masyarakat desa dengan berbagai kebutuhan landingistrasi dan informasi secara digital</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center text-center row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item  position-relative">
                            <div class="icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <a href="#" class="stretched-link" data-bs-toggle="modal" data-bs-target="#requirementModal">
                                <h3>Pembuatan Surat</h3>
                            </a>
                            <p>Masyarakat dapat mengajukan pembuatan berbagai surat seperti surat keterangan domisili,
                                surat
                                izin usaha, dan surat pengantar lainnya secara online.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <a href="#" class="stretched-link" data-bs-toggle="modal" data-bs-target="#requirementModal">
                                <h3>Pengaduan Masyarakat</h3>
                            </a>
                            <p>Warga dapat melaporkan keluhan atau permasalahan terkait infrastruktur, keamanan, dan
                                layanan
                                publik di desa.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <!-- Modal -->
                    <div class="modal modal-lg fade" id="requirementModal" tabindex="-1" aria-labelledby="requirementModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content border-2">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <!-- Kiri -->
                                        <div class="col-md-6 text-light p-3 rounded"
                                            style="background: url('{{ asset('images/background2.png') }}') no-repeat center center;
                                                    background-size: cover; position: relative; overflow: hidden;">

                                            <div class="row position-relative" style="z-index: 2;">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <div class="me-4">
                                                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 100px;">
                                                    </div>
                                                    <div style="text-align: justify;">
                                                        <p class="mb-1">Layanan Desa</p>
                                                        <p class="mb-1">Local Class Tech</p>
                                                        <p class="mb-0">Version: 1.0</p>
                                                    </div>
                                                </div>

                                                <!-- Preview Images -->
                                                <div class="bg-light rounded my-3 px-2 py-3 text-center" style="width: calc(100% - 10px); margin: auto;">
                                                    <div class="d-flex justify-content-center gap-3 flex-nowrap" style="overflow-x: auto;">
                                                        <img src="{{ asset('images/preview1.png') }}" alt="Preview 1" style="width: 90px;">
                                                        <img src="{{ asset('images/preview2.png') }}" alt="Preview 2" style="width: 90px;">
                                                        <img src="{{ asset('images/preview3.png') }}" alt="Preview 3" style="width: 90px;">
                                                    </div>
                                                </div>

                                                <div class="mt-2 mb-2 text-center">
                                                    <button type="button" class="btn text-white fw-bold"
                                                        style="background-color: #1ABAFF; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); width: 180px;"
                                                        onmouseover="this.style.backgroundColor='#004F71'; this.style.border=' 1px solid #ffffff';"
                                                        onmouseout="this.style.backgroundColor='#1ABAFF'; this.style.border=' 1px solid #0071A5'">
                                                        Download
                                                    </button>
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
                                                <li>Mempermudah akses masyarakat terhadap layanan administrasi seperti Pengaduan Surat, Transparansi APBDes, dan informasi desa</li>
                                                <li>Mendukung program digitalisasi desa yang transparan dan akuntabel.</li>
                                            </ol>
                                            <h6 class="mt-3" style="font-size: 14px; color: #4A4A4A"><strong>Desa Akad Fadedo - Melayani dengan Teknologi, Membangun dengan Hati.</strong></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <a href="/berita-desa" class="stretched-link">
                                <h3>Berita dan Informasi</h3>
                            </a>
                            <p>Menyediakan berita terbaru dan informasi seputar kegiatan serta kebijakan desa yang perlu
                                diketahui masyarakat.</p>
                        </div>
                    </div><!-- End Service Item --> --}}

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <a href="{{ route('apbdes.viewUser') }}" class="stretched-link">
                                <h3>Transaparansi APBDes</h3>
                            </a>
                            <p>Menampilkan anggaran pendapatan dan belanja desa secara transparan agar masyarakat dapat
                                mengetahui penggunaan dana desa.</p>
                            <a href="{{ route('apbdes.viewUser') }}" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                    {{-- <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>

                            <h3>Profil dan Struktur Desa</h3>
                            </a>
                            <p>Menampilkan informasi mengenai profil desa, struktur pemerintahan, serta sejarah dan potensi
                                desa.</p>
                            <a href="#" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item --> --}}

                    {{-- <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Digitalisasi Dokumen</h3>
                            </a>
                            <p>Masyarakat dapat mengunggah dan mengelola dokumen penting secara digital untuk kemudahan
                                akses kapan saja.</p>
                            <a href="#" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item --> --}}

                </div>

            </div>

            <!-- /Services Section -->



            <!-- Appointment Section -->
            {{-- <section id="appointment" class="appointment section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>MAKE AN APPOINTMENT</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <form action="forms/appointment.php" method="post" role="form" class="php-email-form">
      <div class="row">
        <div class="col-md-4 form-group">
          <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
        </div>
        <div class="col-md-4 form-group mt-3 mt-md-0">
          <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
        </div>
        <div class="col-md-4 form-group mt-3 mt-md-0">
          <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required="">
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 form-group mt-3">
          <input type="datetime-local" name="date" class="form-control datepicker" id="date" placeholder="Appointment Date" required="">
        </div>
        <div class="col-md-4 form-group mt-3">
          <select name="department" id="department" class="form-select" required="">
            <option value="">Select Department</option>
            <option value="Department 1">Department 1</option>
            <option value="Department 2">Department 2</option>
            <option value="Department 3">Department 3</option>
          </select>
        </div>
        <div class="col-md-4 form-group mt-3">
          <select name="doctor" id="doctor" class="form-select" required="">
            <option value="">Select Doctor</option>
            <option value="Doctor 1">Doctor 1</option>
            <option value="Doctor 2">Doctor 2</option>
            <option value="Doctor 3">Doctor 3</option>
          </select>
        </div>
      </div>

      <div class="form-group mt-3">
        <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
      </div>
      <div class="mt-3">
        <div class="loading">Loading</div>
        <div class="error-message"></div>
        <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
        <div class="text-center"><button type="submit">Make an Appointment</button></div>
      </div>
    </form>

  </div>

</section><!-- /Appointment Section --> --}}

            {{-- <!-- Tabs Section -->
<section id="tabs" class="tabs section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Departments</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row">
      <div class="col-lg-3">
        <ul class="nav nav-tabs flex-column">
          <li class="nav-item">
            <a class="nav-link active show" data-bs-toggle="tab" href="#tabs-tab-1">Cardiology</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-2">Neurology</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-3">Hepatology</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-4">Pediatrics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-5">Ophthalmologists</a>
          </li>
        </ul>
      </div>
      <div class="col-lg-9 mt-4 mt-lg-0">
        <div class="tab-content">
          <div class="tab-pane active show" id="tabs-tab-1">
            <div class="row">
              <div class="col-lg-8 details order-2 order-lg-1">
                <h3>Cardiology</h3>
                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
              </div>
              <div class="col-lg-4 text-center order-1 order-lg-2">
                <img src="assets/img/departments-1.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-tab-2">
            <div class="row">
              <div class="col-lg-8 details order-2 order-lg-1">
                <h3>Neurology</h3>
                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                <p>Ea ipsum voluptatem consequatur quis est. Illum error ullam omnis quia et reiciendis sunt sunt est. Non aliquid repellendus itaque accusamus eius et velit ipsa voluptates. Optio nesciunt eaque beatae accusamus lerode pakto madirna desera vafle de nideran pal</p>
              </div>
              <div class="col-lg-4 text-center order-1 order-lg-2">
                <img src="assets/img/departments-2.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-tab-3">
            <div class="row">
              <div class="col-lg-8 details order-2 order-lg-1">
                <h3>Hepatology</h3>
                <p class="fst-italic">Eos voluptatibus quo. Odio similique illum id quidem non enim fuga. Qui natus non sunt dicta dolor et. In asperiores velit quaerat perferendis aut</p>
                <p>Iure officiis odit rerum. Harum sequi eum illum corrupti culpa veritatis quisquam. Neque necessitatibus illo rerum eum ut. Commodi ipsam minima molestiae sed laboriosam a iste odio. Earum odit nesciunt fugiat sit ullam. Soluta et harum voluptatem optio quae</p>
              </div>
              <div class="col-lg-4 text-center order-1 order-lg-2">
                <img src="assets/img/departments-3.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-tab-4">
            <div class="row">
              <div class="col-lg-8 details order-2 order-lg-1">
                <h3>Pediatrics</h3>
                <p class="fst-italic">Totam aperiam accusamus. Repellat consequuntur iure voluptas iure porro quis delectus</p>
                <p>Eaque consequuntur consequuntur libero expedita in voluptas. Nostrum ipsam necessitatibus aliquam fugiat debitis quis velit. Eum ex maxime error in consequatur corporis atque. Eligendi asperiores sed qui veritatis aperiam quia a laborum inventore</p>
              </div>
              <div class="col-lg-4 text-center order-1 order-lg-2">
                <img src="assets/img/departments-4.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
          <div class="tab-pane" id="tabs-tab-5">
            <div class="row">
              <div class="col-lg-8 details order-2 order-lg-1">
                <h3>Ophthalmologists</h3>
                <p class="fst-italic">Omnis blanditiis saepe eos autem qui sunt debitis porro quia.</p>
                <p>Exercitationem nostrum omnis. Ut reiciendis repudiandae minus. Omnis recusandae ut non quam ut quod eius qui. Ipsum quia odit vero atque qui quibusdam amet. Occaecati sed est sint aut vitae molestiae voluptate vel</p>
              </div>
              <div class="col-lg-4 text-center order-1 order-lg-2">
                <img src="assets/img/departments-5.jpg" alt="" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</section><!-- /Tabs Section --> --}}

            <!-- Galeri Section -->

            {{-- <section id="testimonials" class="testimonials section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Galeri</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper" data-speed="600" data-delay="5000"
                data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
                <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": {
            "delay": 5000
          },
          "slidesPerView": "auto",
          "pagination": {
            "el": ".swiper-pagination",
            "type": "bullets",
            "clickable": true
          },
          "breakpoints": {
            "320": {
              "slidesPerView": 1,
              "spaceBetween": 40
            },
            "1200": {
              "slidesPerView": 3,
              "spaceBetween": 20
            }
          }
        }
      </script>
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('landing/assets/img/gallery/bagimesinparut.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Pembagian Mesin Parut ke Masyarakat</h3>
                        </div>
                    </div><!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="{{ asset('landing/assets/img/gallery/musdus.jpg') }}" class="testimonial-img"
                                alt="">
                            <h3>Musyawarah Dusun</h3>
</div>
                    </div><!-- End testimonial item -->


                    <div class="swiper-slide">
                        <div class="testimonial-item">

                            <img src="{{ asset('landing/assets/img/gallery/bagipipa.jpg') }}" class="testimonial-img"
                                alt="">
                            <h3>Pembagian Pipa</h3>

                        </div>
                    </div><!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-item">

                            <img src="{{ asset('landing/assets/img/gallery/pkk.jpg') }}" class="testimonial-img"
                                alt="">
                            <h3>Penanaman Bibit Bersama Ibu PKK</h3>

                        </div>
                    </div><!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-item">

                            <img src="{{ asset('landing/assets/img/gallery/blt.jpg') }}" class="testimonial-img"
                                alt="">
                            <h3>Penyaluran BLT Extrim Dana Desa Tahun 2024</h3>

                        </div>
                    </div><!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-item">

                            <img src="{{ asset('landing/assets/img/gallery/musrembang.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Musyawarah Perencanaan Pembangunan Desa T.A 2025</h3>

                        </div>
                    </div><!-- End testimonial item -->
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-item">

                                <img src="{{ asset('landing/assets/img/testimonials/testimonials-3.jpg') }}"
                                    class="testimonial-img" alt="">
                                <h3>Jena Karlis</h3>
                                <h4>Store Owner</h4>
                            </div>
                        </div>
                    </div><!-- End testimonial item -->
                        </div><!-- End testimonial item -->
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ asset('landing/assets/img/gallery/musdus.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>Musyawarah Dusun</h3>
 </div>
                        </div><!-- End testimonial item -->

                    <!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section> --}}
            <!-- /Galeri -->
            <!-- Galeri Section -->
            {{-- di uncoment kalau sudah selesai --}}

            {{-- berita --}}

            <div id="newspapers" class="newspapers section">
                <div class="container section-title" data-aos="fade-up">
                    <h2>Berita Desa</h2>
                    <p>Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari
                        desa.</p>
                </div>

                <div class="container mt-3">
                    {{-- <h2 class="text-info font-weight-bold fs-1 mb-2">Berita Desa</h2>
                <p class="mb-4">Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel jurnalistik dari Desa.</p> --}}

                    <div class="row">
                        @forelse ($berita as $item)
                            <div class="col-md-4 mb-4">
                                <a href="{{ route('berita.show', $item->slug) }}"
                                    style="text-decoration: none; color: inherit;">
                                    <div class="card shadow-sm h-100">
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top"
                                            style="height: 220px; object-fit: cover;" alt="...">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">
                                                {{ \Illuminate\Support\Str::limit($item->judul, 60) }}
                                            </h5>
                                            <p class="card-text text-muted mb-2">
                                                {!! \Illuminate\Support\Str::limit(strip_tags($item->konten), 120) !!}
                                            </p>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    <i class="fas fa-user"></i>
                                                    {{ $item->user->name ?? 'Administrator' }}<br>
                                                    <i class="fas fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}<br>
                                                    <i class="fas fa-eye"></i> Dilihat {{ $item->views ?? 0 }} kali
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">Belum ada berita yang tersedia.</div>
                            </div>
                        @endforelse
                        <div class="text-end my-4">
                            <a href="{{ route('home.daftar-berita') }}" class="lihat-berita-link">
                                <i class="fas fa-file-alt"></i> LIHAT BERITA LEBIH BANYAK
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="testimonials" class="testimonials section">

                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>Galeri</h2>
                    <p>Dokumentasi kegiatan dan acara di desa kami.</p>
                </div><!-- End Section Title -->

                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper init-swiper" data-speed="600" data-delay="5000"
                        data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">

                        <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "breakpoints": {
                                "320": {
                                "slidesPerView": 1,
                                "spaceBetween": 40
                                },
                                "1200": {
                                "slidesPerView": 3,
                                "spaceBetween": 20
                                }
                            }
                        }
                        </script>

                        <div class="swiper-wrapper">
                            @forelse ($galeri as $item)
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <img src="{{ asset('storage/' . $item->image) }}" class="testimonial-img"
                                            alt="{{ $item->nama_kegiatan }}">
                                        <h3 class="text-center">{{ $item->nama_kegiatan }}</h3>
                                    </div>
                                </div><!-- End testimonial item -->
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">Belum ada gambar yang tersedia.</div>
                                </div>
                            @endforelse
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="text-end my-4">
                            <a href="{{ route('home.daftar-galeri') }}" class="lihat-berita-link">
                                <i class="fas fa-file-alt"></i> LIHAT GALERI LEBIH BANYAK
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- /Galeri -->

        {{-- <!-- Pricing Section -->
<section id="pricing" class="pricing section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Pricing</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-3">

      <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <div class="pricing-item">
          <h3>Free</h3>
          <h4><sup>$</sup>0<span> / month</span></h4>
          <ul>
            <li>Aida dere</li>
            <li>Nec feugiat nisl</li>
            <li>Nulla at volutpat dola</li>
            <li class="na">Pharetra massa</li>
            <li class="na">Massa ultricies mi</li>
          </ul>
          <div class="btn-wrap">
            <a href="#" class="btn-buy">Buy Now</a>
          </div>
        </div>
      </div><!-- End Pricing Item -->

      <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <div class="pricing-item featured">
          <h3>Business</h3>
          <h4><sup>$</sup>19<span> / month</span></h4>
          <ul>
            <li>Aida dere</li>
            <li>Nec feugiat nisl</li>
            <li>Nulla at volutpat dola</li>
            <li>Pharetra massa</li>
            <li class="na">Massa ultricies mi</li>
          </ul>
          <div class="btn-wrap">
            <a href="#" class="btn-buy">Buy Now</a>
          </div>
        </div>
      </div><!-- End Pricing Item -->

      <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="400">
        <div class="pricing-item">
          <h3>Developer</h3>
          <h4><sup>$</sup>29<span> / month</span></h4>
          <ul>
            <li>Aida dere</li>
            <li>Nec feugiat nisl</li>
            <li>Nulla at volutpat dola</li>
            <li>Pharetra massa</li>
            <li>Massa ultricies mi</li>
          </ul>
          <div class="btn-wrap">
            <a href="#" class="btn-buy">Buy Now</a>
          </div>
        </div>
      </div><!-- End Pricing Item -->

      <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="400">
        <div class="pricing-item">
          <span class="advanced">Advanced</span>
          <h3>Ultimate</h3>
          <h4><sup>$</sup>49<span> / month</span></h4>
          <ul>
            <li>Aida dere</li>
            <li>Nec feugiat nisl</li>
            <li>Nulla at volutpat dola</li>
            <li>Pharetra massa</li>
            <li>Massa ultricies mi</li>
          </ul>
          <div class="btn-wrap">
            <a href="#" class="btn-buy">Buy Now</a>
          </div>
        </div>
      </div><!-- End Pricing Item -->

    </div>

  </div>

</section><!-- /Pricing Section --> --}}

        <!-- Faq Section -->
        {{-- <section id="faq" class="faq section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Frequently Asked Questions</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit
            </p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                    <div class="faq-container">

                        <div class="faq-item">
                            <h3>Non consectetur a erat nam at lectus urna duis?</h3>
                            <div class="faq-content">
                                <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id
                                    volutpat lacus laoreet
                                    non curabitur gravida. Venenatis lectus magna fringilla urna
                                    porttitor rhoncus dolor
                                    purus non.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Feugiat scelerisque varius morbi enim nunc faucibus?</h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque
                                    habitant morbi. Id interdum
                                    velit laoreet id donec ultrices. Fringilla phasellus
                                    faucibus scelerisque eleifend
                                    donec pretium. Est pellentesque elit ullamcorper dignissim.
                                    Mauris ultrices eros in
                                    cursus turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
                            <div class="faq-content">
                                <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices
                                    sagittis orci. Faucibus
                                    pulvinar elementum integer enim. Sem nulla pharetra diam sit
                                    amet nisl suscipit.
                                    Rutrum tellus pellentesque eu tincidunt. Lectus urna duis
                                    convallis convallis
                                    tellus. Urna molestie at elementum eu facilisis sed odio
                                    morbi quis</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque
                                    habitant morbi. Id interdum
                                    velit laoreet id donec ultrices. Fringilla phasellus
                                    faucibus scelerisque eleifend
                                    donec pretium. Est pellentesque elit ullamcorper dignissim.
                                    Mauris ultrices eros in
                                    cursus turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Tempus quam pellentesque nec nam aliquam sem et tortor?</h3>
                            <div class="faq-content">
                                <p>Molestie a iaculis at erat pellentesque adipiscing commodo.
                                    Dignissim suspendisse in
                                    est ante in. Nunc vel risus commodo viverra maecenas
                                    accumsan. Sit amet nisl
                                    suscipit adipiscing bibendum est. Purus gravida quis blandit
                                    turpis cursus in</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>Perspiciatis quod quo quos nulla quo illum ullam?</h3>
                            <div class="faq-content">
                                <p>Enim ea facilis quaerat voluptas quidem et dolorem. Quis et
                                    consequatur non sed in
                                    suscipit sequi. Distinctio ipsam dolore et.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div><!-- End Faq Column-->

            </div>

        </div>

    </section><!-- /Faq Section --> --}}

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Lokasi</h2>
                <p>Temukan lokasi Desa Akat Fadedo di peta berikut.
                    Silakan kunjungi jika ada keperluan atau ingin mengetahui
                    lebih dekat tentang desa kami.
                </p>
            </div><!-- End Section Title -->

            <div class="mx-2 mb-5" data-aos="fade-up" data-aos-delay="200">
                <iframe style="border:0; width: 100%; height: 370px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1442.3112557462064!2d130.71061032854638!3d-3.8241932616395586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d40810037fec673%3A0x4407ad62fb3b89d6!2sKantor%20Desa%20Akat%20Fadedo!5e1!3m2!1sid!2sid!4v1738774423050!5m2!1sid!2sid"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div><!-- End Google Maps -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <!-- Section Title -->
                <div class="container section-title" data-aos="fade-up">
                    <h2>KONTAK</h2>
                    <p>Hubungi Kami
                    </p>
                </div><!-- End Section Title -->

                <div class="row gy-4">
                    <div class="col-lg-6 ">
                        <div class="row gy-4">

                            <div class="col-lg-12">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Alamat</h3>
                                    <p>Desa Akat Fadedo, Kec. Seram Timur, Kabupaten Seram Bagian
                                        Timur, Maluku</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>No Telp</h3>
                                    <p>+62-82223607709</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>info@example.com</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="500">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"
                                        required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="4" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank
                                        you!</div>

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>
@endsection
