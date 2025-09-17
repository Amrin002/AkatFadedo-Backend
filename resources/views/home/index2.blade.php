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
                    {{-- Stats Section dengan Pie Chart --}}
                    <section id="stats" class="stats section">
                        <div class="container" data-aos="fade-up" data-aos-delay="100">

                            {{-- Summary Stats --}}
                            <div class="stats-summary" data-aos="fade-up" data-aos-delay="200">
                                <div class="row">
                                    <div class="col-md-3 col-6">
                                        <div class="summary-item">
                                            <span class="summary-number">{{ number_format($jumlahPenduduk) }}</span>
                                            <div class="summary-label">Total Penduduk</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="summary-item">
                                            <span class="summary-number">
                                                {{ ($fasilitas->fasilitas_pendidikan ?? 0) + ($fasilitas->fasilitas_kesehatan ?? 0) }}
                                            </span>
                                            <div class="summary-label">Total Fasilitas</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="summary-item">
                                            <span class="summary-number">{{ $fasilitas->luas_wilayah ?? 0 }}</span>
                                            <div class="summary-label">Luas Wilayah (km²)</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="summary-item">
                                            <span class="summary-number">
                                                {{ $fasilitas && $fasilitas->luas_wilayah > 0 ? number_format($jumlahPenduduk / $fasilitas->luas_wilayah, 0) : 0 }}
                                            </span>
                                            <div class="summary-label">Kepadatan/km²</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Charts Row --}}
                            <div class="row gy-4">
                                {{-- Pie Chart Penduduk --}}
                                <div class="col-lg-6 col-md-12">
                                    <div class="chart-container" data-aos="fade-up" data-aos-delay="300">
                                        <div class="chart-title">Komposisi Penduduk</div>
                                        <canvas id="pendudukChart"></canvas>
                                        <div class="legend-custom">
                                            <div class="legend-item">
                                                <div class="legend-color" style="background-color: #3498db;"></div>
                                                <span>Laki-laki</span>
                                            </div>
                                            <div class="legend-item">
                                                <div class="legend-color" style="background-color: #e74c3c;"></div>
                                                <span>Perempuan</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Pie Chart Fasilitas --}}
                                <div class="col-lg-6 col-md-12">
                                    <div class="chart-container" data-aos="fade-up" data-aos-delay="400">
                                        <div class="chart-title">Distribusi Fasilitas</div>
                                        <canvas id="fasilitasChart"></canvas>
                                        <div class="legend-custom">
                                            <div class="legend-item">
                                                <div class="legend-color" style="background-color: #2ecc71;"></div>
                                                <span>Pendidikan</span>
                                            </div>
                                            <div class="legend-item">
                                                <div class="legend-color" style="background-color: #f39c12;"></div>
                                                <span>Kesehatan</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- JavaScript untuk Chart --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Data dari Laravel Backend
                            const dataPenduduk = {
                                lakiLaki: {{ $pendudukLakiLaki ?? floor($jumlahPenduduk * 0.52) }}, // Estimasi jika tidak ada data gender
                                perempuan: {{ $pendudukPerempuan ?? floor($jumlahPenduduk * 0.48) }}
                            };

                            const dataFasilitas = {
                                pendidikan: {{ $fasilitas->fasilitas_pendidikan ?? 0 }},
                                kesehatan: {{ $fasilitas->fasilitas_kesehatan ?? 0 }},
                                umum: {{ $fasilitas->fasilitas_umum ?? 0 }}
                            };

                            // Chart configuration
                            const chartOptions = {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false // We'll use custom legend
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const label = context.label || '';
                                                const value = context.raw;
                                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                const percentage = ((value / total) * 100).toFixed(1);
                                                return `${label}: ${value.toLocaleString('id-ID')} (${percentage}%)`;
                                            }
                                        }
                                    }
                                },
                                animation: {
                                    animateRotate: true,
                                    animateScale: true,
                                    duration: 2000
                                }
                            };

                            // Penduduk Chart
                            const pendudukCtx = document.getElementById('pendudukChart').getContext('2d');
                            new Chart(pendudukCtx, {
                                type: 'pie',
                                data: {
                                    labels: ['Laki-laki', 'Perempuan'],
                                    datasets: [{
                                        data: [dataPenduduk.lakiLaki, dataPenduduk.perempuan],
                                        backgroundColor: ['#3498db', '#e74c3c'],
                                        borderWidth: 3,
                                        borderColor: '#fff',
                                        hoverBorderWidth: 5,
                                        hoverOffset: 10
                                    }]
                                },
                                options: chartOptions
                            });

                            // Fasilitas Chart - Hanya tampilkan jika ada data
                            const totalFasilitas = dataFasilitas.pendidikan + dataFasilitas.kesehatan + dataFasilitas.umum;
                            if (totalFasilitas > 0) {
                                const fasilitasCtx = document.getElementById('fasilitasChart').getContext('2d');
                                new Chart(fasilitasCtx, {
                                    type: 'pie',
                                    data: {
                                        labels: ['Pendidikan', 'Kesehatan'],
                                        datasets: [{
                                            data: [dataFasilitas.pendidikan, dataFasilitas.kesehatan, dataFasilitas
                                                .umum
                                            ],
                                            backgroundColor: ['#2ecc71', '#f39c12', '#9b59b6'],
                                            borderWidth: 3,
                                            borderColor: '#fff',
                                            hoverBorderWidth: 5,
                                            hoverOffset: 10
                                        }]
                                    },
                                    options: chartOptions
                                });
                            } else {
                                // Tampilkan pesan jika tidak ada data fasilitas
                                const fasilitasContainer = document.getElementById('fasilitasChart').parentElement;
                                fasilitasContainer.innerHTML =
                                    '<div class="text-center p-4"><p class="text-muted">Data fasilitas belum tersedia</p></div>';
                            }

                            // Add interactive animations
                            document.querySelectorAll('.chart-container').forEach(container => {
                                container.addEventListener('mouseenter', function() {
                                    this.style.transform = 'translateY(-5px) scale(1.02)';
                                });

                                container.addEventListener('mouseleave', function() {
                                    this.style.transform = 'translateY(0) scale(1)';
                                });
                            });
                        });
                    </script>

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
                            <a href="#" class="stretched-link" data-bs-toggle="modal"
                                data-bs-target="#requirementModal">
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
                            <a href="#" class="stretched-link" data-bs-toggle="modal"
                                data-bs-target="#requirementModal">
                                <h3>Pengaduan Masyarakat</h3>
                            </a>
                            <p>Warga dapat melaporkan keluhan atau permasalahan terkait infrastruktur, keamanan, dan
                                layanan
                                publik di desa.</p>
                        </div>
                    </div><!-- End Service Item -->
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



                    {{-- berita --}}

                    <div id="newspapers" class="newspapers section">
                        <div class="container section-title" data-aos="fade-up">
                            <h2>Berita Desa</h2>
                            <p>Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan artikel-artikel
                                jurnalistik dari
                                desa.</p>
                        </div>

                        <div class="container mt-3">

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
                                                            <i class="fas fa-eye"></i> Dilihat {{ $item->views ?? 0 }}
                                                            kali
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
