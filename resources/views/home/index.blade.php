@extends("layouts.main")
@push("styles")
				<style>
								/* ====================
																																																																																																																																																																												GAYA UNTUK SETIAP SEKSI
																																																																																																																																																																								==================== */
								.hero-section {
												background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset("landing/assets/img/hero-carousel/hero-carousel.jpg") }}');
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

								.border-item {
												padding: 0.25rem 0;
												margin-left: 2rem;
												border-left: 3px solid #17a2b8;
												padding-left: 1rem;
												margin-bottom: 0.5rem;
								}

								.info-item {
												display: flex;
												align-items: flex-start;
												margin-bottom: 1rem;
												padding: 0.5rem 0;
								}

								.info-item i {
												margin-right: 0.75rem;
												margin-top: 0.25rem;
												font-size: 1.1rem;
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

								.modal-backdrop.show {
												opacity: 0.2 !important;
								}
				</style>
@endpush
@section("content")
				<!-- Bagian Hero -->
				<section id="beranda" class="hero-section">
								<div class="container p-4">
												<h1 class="mb-4 display-3 fw-bold reveal">Selamat Datang di Desa Akat Fadedo</h1>
												<p class="mb-5 lead reveal">
																Membangun desa yang maju dan harmonis, berlandaskan kearifan lokal serta inovasi demi kesejahteraan
																masyarakat
												</p>

												<!-- Tombol -->
												<div class="gap-3 d-flex flex-column flex-sm-row justify-content-center align-items-center reveal">
																<a href="#tentang" class="shadow-sm btn btn-primary btn-lg rounded-pill">
																				<i class="fas fa-compass me-2"></i>Jelajahi Desa
																</a>

																@if (isset($latestAppVersion) && $latestAppVersion->full_download_url)
																				<!-- Kalau ada file -->
																				<a href="{{ route("download.apk", $latestAppVersion->id) }}"
																								class="shadow-sm btn btn-success btn-lg rounded-pill">
																								<i class="fab fa-android me-2"></i>Download Aplikasi
																				</a>
																@else
																				<!-- Kalau nggak ada file -->
																				<button class="shadow-sm btn btn-success btn-lg rounded-pill" data-bs-toggle="modal"
																								data-bs-target="#downloadModal">
																								<i class="fab fa-android me-2"></i>Download Aplikasi
																				</button>
																@endif
												</div>
								</div>
				</section>

				<!-- Modal -->
				<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered">
												<div class="modal-content">
																<div class="modal-header bg-warning text-dark">
																				<h5 class="modal-title" id="downloadModalLabel">Pemberitahuan</h5>
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
																</div>
																<div class="text-center modal-body">
																				<i class="mb-3 fas fa-exclamation-triangle fa-3x text-warning"></i>
																				<p class="mb-0 fw-bold">Aplikasi Belum Tersedia</p>
																</div>
																<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
																</div>
												</div>
								</div>
				</div>

				<!-- Bagian Tentang Desa -->
				<section id="tentang" class="py-5 my-5">
								<div class="container">
												<div class="row align-items-center g-5">
																<div class="col-lg-6 reveal">
																				<img src="{{ asset("landing/assets/img/ProfilDesa.jpg") }}" alt="Tentang Desa"
																								class="shadow-sm img-fluid rounded-4">
																</div>
																<div class="col-lg-6 reveal">
																				<h2 class="text-lg text-center section-title">Tentang Desa Akat Fadedo</h2>
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
																				<a href="{{ route("home.tentang-desa") }}"
																								class="mt-4 shadow-sm btn btn-primary rounded-pill">Selengkapnya</a>
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
																				<div class="geographic-info h-100">
																								<h5 class="mb-4 fw-bold text-dark">Informasi Geografis</h5>
																								<div class="info-item">
																												<i class="fas fa-map-marked-alt me-2 text-info"></i>
																												<div>
																																<strong>Luas Wilayah:</strong> ± 500 m²
																												</div>
																								</div>

																								<div class="info-item">
																												<i class="fas fa-border-all text-info"></i>
																												<div>
																																<strong>Batas Wilayah:</strong>
																												</div>
																								</div>

																								<div class="border-item">
																												<i class="fas fa-arrow-up text-info me-2"></i>
																												<strong>Utara:</strong> Berbatasan dengan Gunung Teri
																								</div>
																								<div class="border-item">
																												<i class="fas fa-arrow-down text-info me-2"></i>
																												<strong>Selatan:</strong> Berbatasan dengan Laut Banda
																								</div>
																								<div class="border-item">
																												<i class="fas fa-arrow-right text-info me-2"></i>
																												<strong>Timur:</strong> Berbatasan dengan Desa Mugusinis
																								</div>
																								<div class="border-item">
																												<i class="fas fa-arrow-left text-info me-2"></i>
																												<strong>Barat:</strong> Berbatasan dengan Desa Sumbawa
																								</div>

																								<div class="mt-4">
																												<h5 class="mb-3 fw-bold text-dark">Kondisi Topografi</h5>
																												<p class="text-justify-custom text-muted">
																																Kondisi topografi Desa Akat Fadedo dicirikan oleh lanskap yang bervariasi, terbentang dari
																																pesisir hingga ke area pedalaman. Wilayahnya secara umum didominasi oleh kombinasi antara
																																dataran rendah yang subur di dekat garis pantai serta kawasan perbukitan landai dengan
																																ketinggian berkisar antara 100 hingga 300 meter di atas permukaan laut. Kondisi alam yang
																																subur ini menjadikan sebagian besar wilayah desa sangat ideal untuk dikembangkan sebagai
																																lahan pertanian dan perkebunan.
																												</p>
																								</div>
																				</div>
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
																<a href="{{ route("home.profil-desa") }}" class="px-4 btn btn-outline-primary rounded-pill">
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
																																								Total Anggaran: Rp {{ number_format($apbdes->pendapatan, 0, ",", ".") }}
																																				</p>
																																@else
																																				<p class="text-muted">Data APBDes belum tersedia.</p>
																																@endif
																												</div>
																								</div>
																								<p class="card-text text-muted">Informasi ini mencakup rincian alokasi dana untuk pembangunan,
																												pemberdayaan, dan penyelenggaraan pemerintahan desa.</p>
																								<ul class="mb-4 list-unstyled text-start">
																												<li class="mb-1 text-muted">
																																<i class="fas fa-user-tie me-2 text-info"></i>
																																Disahkan oleh:
																																@if ($apbdes && $apbdes->pejabat)
																																				{{ $apbdes->pejabat }}
																																@else
																																				<span class="text-secondary">Belum diset</span>
																																@endif
																												</li>
																												<li class="text-muted">
																																<i class="far fa-calendar-alt me-2 text-info"></i>
																																Terakhir diperbarui:
																																@if ($apbdes && $apbdes->updated_at)
																																				{{ $apbdes->updated_at->locale("id")->diffForHumans() }}
																																@else
																																				<span class="text-secondary">-</span>
																																@endif
																												</li>
																								</ul>
																								<a href="{{ route("home.profil-desa") }}#transparansi"
																												class="px-4 btn btn-outline-primary rounded-pill align-self-end">
																												Lihat Selengkapnya
																								</a>
																				</div>
																</div>
												</div>
								</div>
				</section>

				<!-- Bagian Struktur Pemerintahan Desa -->
				<section id="struktur-desa" class="py-5 my-5 team section bg-light">
								<div class="container mb-5 text-center section-title" data-aos="fade-up">
												<h2 class="fw-bold">Struktur Pemerintahan Desa</h2>
												<p class="text-muted">Susunan kepengurusan desa yang bertanggung jawab atas administrasi dan pelayanan
																masyarakat.</p>
								</div>

								<div class="container">
												<div class="row gy-4 justify-content-center">
																@forelse ($strukturDesa as $anggota)
																				<div class="col-lg-3 col-md-6 d-flex align-items-stretch reveal" data-aos="fade-up"
																								data-aos-delay="100">
																								<div class="overflow-hidden text-center border-0 shadow-sm team-member card rounded-4 w-100">

																												<!-- Foto -->
																												<div class="mt-4 member-img position-relative">
																																@if (!empty($anggota->image))
																																				<img src="{{ asset("storage/" . $anggota->image) }}" alt="{{ $anggota->nama }}"
																																								class="shadow-sm img-fluid rounded-circle"
																																								style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #fff;">
																																@else
																																				<img src="{{ asset("images/strukturdesa_default.png") }}" alt="Foto Default"
																																								class="shadow-sm img-fluid rounded-circle"
																																								style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #fff;">
																																@endif
																												</div>

																												<!-- Info Anggota -->
																												<div class="member-info card-body">
																																<h5 class="mb-1 fw-bold text-dark">{{ $anggota->nama }}</h5>
																																<p class="mb-3 text-muted small">{{ $anggota->jabatan ?? $anggota->posisi }}</p>

																																<!-- Sosial Media -->
																																<div class="gap-2 mt-3 social d-flex justify-content-center">
																																				@if ($anggota->twitter)
																																								<a href="{{ $anggota->twitter }}" target="_blank" class="social-icon twitter"
																																												title="Twitter/X">
																																												<i class="bi bi-twitter-x"></i>
																																								</a>
																																				@endif
																																				@if ($anggota->facebook)
																																								<a href="{{ $anggota->facebook }}" target="_blank" class="social-icon facebook"
																																												title="Facebook">
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
																								<div class="text-center alert alert-info">Belum ada struktur desa yang tersedia.</div>
																				</div>
																@endforelse
												</div>

												<!-- Tombol Selengkapnya -->
												<div class="mt-5 text-center reveal">
																<a href="{{ route("home.tentang-desa") }}" class="px-4 btn btn-outline-primary rounded-pill">
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
																<!-- Card 1 -->
																<div class="col-md-6 col-lg-4 d-flex reveal">
																				<div class="p-3 text-center card card-layanan w-100">
																								<div class="card-body">
																												<i class="mb-3 fas fa-clipboard-list fa-3x text-info"></i>
																												<h3 class="mb-2 card-title h4">Layanan Administrasi</h3>
																												<p class="card-text text-muted">Masyarakat dapat mengajukan pembuatan berbagai surat seperti
																																surat keterangan domisili,
																																surat izin usaha, dan surat pengantar lainnya secara online.</p>
																												<a href="#" class="mt-3 btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal"
																																data-bs-target="#requirementModal">
																																Selengkapnya
																												</a>
																								</div>
																				</div>
																</div>

																<!-- Card 2 -->
																<div class="col-md-6 col-lg-4 d-flex reveal">
																				<div class="p-3 text-center card card-layanan w-100">
																								<div class="card-body">
																												<i class="mb-3 fas fa-handshake fa-3x text-info"></i>
																												<h3 class="mb-2 card-title h4">Pengaduan Masyarakat</h3>
																												<p class="card-text text-muted">Masyarakat dapat melaporkan keluhan atau permasalahan terkait
																																infrastruktur, keamanan, dan layanan publik di desa.</p>
																												<a href="#" class="mt-3 btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal"
																																data-bs-target="#requirementModal">
																																Selengkapnya
																												</a>
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</section>

				<!-- Modal Requirement -->
				<div class="modal fade" id="requirementModal" tabindex="-1" aria-labelledby="requirementModalLabel"
								aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered">
												<div class="border-2 modal-content">
																<div class="modal-header">
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>

																<div class="modal-body">
																				<div class="row g-3">
																								<!-- Kiri -->
																								<div class="p-3 rounded col-md-6 text-light"
																												style="background: url('{{ asset("images/background2.png") }}') no-repeat center center;
                                        background-size: cover; position: relative; overflow: hidden;">

																												<div class="row position-relative" style="z-index: 2;">
																																<div class="d-flex justify-content-center align-items-center">
																																				<div class="me-4">
																																								<img src="{{ asset("images/logo.png") }}" alt="Logo" class="img-fluid"
																																												style="max-width: 100px;">
																																				</div>
																																				<div style="text-align: justify;">
																																								<p class="mb-1">Layanan Desa</p>
																																								<p class="mb-1">Local Class Tech</p>
																																								<p class="mb-0">
																																												Versi :
																																												@if ($latestAppVersion)
																																																{{ $latestAppVersion->version }}
																																												@else
																																																<span>-</span>
																																												@endif
																																								</p>
																																								<p class="mb-0">
																																												Rilis :
																																												@if ($latestAppVersion)
																																																{{ $latestAppVersion->formatted_release_date }}
																																												@else
																																																<span>-</span>
																																												@endif
																																								</p>
																																				</div>
																																</div>

																																<!-- Preview Images -->
																																<div class="px-2 py-3 my-3 text-center rounded bg-light"
																																				style="width: calc(100% - 10px); margin: auto;">
																																				<div class="gap-3 d-flex justify-content-center flex-nowrap"
																																								style="overflow-x: auto;">
																																								<img src="{{ asset("images/preview1.png") }}" alt="Preview 1"
																																												style="width: 90px;">
																																								<img src="{{ asset("images/preview2.png") }}" alt="Preview 2"
																																												style="width: 90px;">
																																								<img src="{{ asset("images/preview3.png") }}" alt="Preview 3"
																																												style="width: 90px;">
																																				</div>
																																</div>

																																<div class="mt-2 mb-2 text-center">
																																				@if ($latestAppVersion)
																																								<a href="{{ $latestAppVersion->full_download_url }}" download
																																												class="border shadow-sm btn btn-white btn-sm rounded-pill">
																																												<i class="fas fa-code-branch me-1"></i>
																																												Versi v{{ $latestAppVersion->version }}
																																								</a>
																																								<div class="mt-2">
																																												<small class="text-muted">
																																																<i class="fas fa-database me-1"></i>
																																																Ukuran: {{ $latestAppVersion->file_size }}
																																												</small>
																																								</div>
																																				@else
																																								<button class="btn btn-secondary btn-sm rounded-pill" disabled>
																																												<i class="fas fa-code-branch me-1"></i>
																																												Versi Belum Tersedia
																																								</button>
																																				@endif
																																</div>
																												</div>
																								</div>

																								<!-- Kanan -->
																								<div class="px-3 pt-2 col-md-6 text-light" style="text-align: justify">
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

				{{-- section umkm --}}
				<section id="umkm" class="py-5 my-5">
								<div class="container">
												<h2 class="text-center section-title">UMKM Desa</h2>
												<p class="mb-5 text-center text-muted">Produk unggulan dan usaha kreatif masyarakat Desa Akat Fadedo</p>

												@if ($umkm->isEmpty())
																<p class="text-center text-muted">Data UMKM belum tersedia.</p>
												@else
																<div class="row g-4">
																				@foreach ($umkm as $item)
																								<div class="col-lg-4 col-md-6 d-flex reveal">
																												<div class="shadow-sm card card-layanan w-100">
																																<img src="{{ asset("storage/" . $item->foto_produk) }}" class="card-img-top"
																																				alt="{{ $item->nama_produk }}" style="height: 200px; object-fit: cover;">
																																<div class="card-body">
																																				<div class="mb-2 d-flex justify-content-between align-items-start">
																																								<span class="badge bg-info">{{ $item->kategori_label }}</span>
																																								<small class="text-muted">{{ $item->penduduk->nama_lengkap ?? "N/A" }}</small>
																																				</div>
																																				<h5 class="card-title">{{ $item->nama_usaha }}</h5>
																																				<h6 class="mb-2 card-subtitle text-muted">{{ $item->nama_produk }}</h6>

																																				<!-- Tambahan Harga Produk -->
																																				@if ($item->harga_produk)
																																								<div class="mb-2">
																																												<span class="fw-bold text-success fs-5">
																																																Rp {{ number_format($item->harga_produk, 0, ",", ".") }}
																																												</span>
																																								</div>
																																				@endif

																																				<p class="card-text">{{ Str::limit($item->deskripsi_produk, 80) }}</p>
																																				<div class="d-flex justify-content-between align-items-center">
																																								<a href="{{ route("umkm.public.show", $item->id) }}"
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
																<a href="{{ route("umkm.public.index") }}" class="px-4 btn btn-outline-primary rounded-pill">
																				<i class="fas fa-store me-2"></i>Lihat Semua UMKM
																</a>
												</div>
								</div>
				</section>

				<!-- Bagian Galeri Foto -->
<section id="galeri" class="py-5 my-5 bg-light">
    <div class="container">
        <h2 class="mb-4 text-center fw-bold section-title">Galeri Foto</h2>

        @if ($galeri->isEmpty())
            <p class="text-center text-muted">Galeri foto belum tersedia.</p>
        @else
            {{-- Filter berdasarkan Label Kegiatan --}}
            @php
                $kegiatanGroups = $galeri->groupBy('kegiatan_desa_id');
            @endphp

            {{-- @if ($kegiatanGroups->count() > 1)
                <div class="mb-4 text-center">
                    <div class="btn-group flex-wrap" role="group">
                        <button type="button" class="btn btn-outline-primary active filter-btn" data-filter="all">
                            Semua
                        </button>
                        @foreach ($kegiatanGroups as $kegiatanId => $items)
                            @if ($kegiatanId && $items->first()->kegiatan)
                                <button type="button" class="btn btn-outline-primary filter-btn" data-filter="kegiatan-{{ $kegiatanId }}">
                                    {{ $items->first()->kegiatan->judul }}
                                </button>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif --}}

            <div class="masonry-grid">
                @foreach ($galeri as $item)
                    <div class="masonry-item galeri-item" data-category="{{ $item->kegiatan_desa_id ? 'kegiatan-' . $item->kegiatan_desa_id : 'tanpa-label' }}">
                        <div class="border-0 shadow-sm card galeri-card h-100">
                            <img src="{{ asset('storage/' . $item->image) }}" 
                                 alt="{{ $item->nama_kegiatan }}"
                                 class="galeri-img img-gallery" 
                                 data-bs-toggle="modal" 
                                 data-bs-target="#galleryModal"
                                 data-img-src="{{ asset('storage/' . $item->image) }}"
                                 data-title="{{ $item->nama_kegiatan }}">
                            <div class="p-3">
                                <h6 class="mb-2 fw-semibold">{{ $item->nama_kegiatan }}</h6>
                                @if ($item->kegiatan)
                                    <span class="badge bg-primary">
                                        <i class="fas fa-tag me-1"></i>{{ $item->kegiatan->judul }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-image me-1"></i>Tanpa Label
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Tombol Selengkapnya -->
        <div class="mt-5 text-center reveal">
            <a href="{{ route('home.daftar-galeri') }}" class="px-4 btn btn-outline-primary rounded-pill">
                <i class="fas fa-images me-1"></i> Lihat Semua Galeri
            </a>
        </div>
    </div>
</section>

<!-- Modal Galeri -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="overflow-hidden text-white border-0 shadow-lg modal-content bg-dark rounded-4">
            <div class="p-0 modal-body position-relative">
                <!-- Gambar -->
                <img id="modalImage" src="" alt="Gambar Galeri"
                    class="img-fluid w-100 d-block animate__animated animate__zoomIn">

                <!-- Caption -->
                <div class="bottom-0 p-3 bg-opacity-75 bg-dark position-absolute start-0 w-100">
                    <h5 id="modalTitle" class="mb-0 text-center fw-semibold"></h5>
                </div>

                <!-- Tombol Tutup -->
                <button type="button" class="top-0 m-3 btn-close btn-close-white position-absolute end-0"
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



@push('scripts')
<script>
    // Filter Galeri berdasarkan Label
    // document.addEventListener('DOMContentLoaded', function() {
    //     const filterBtns = document.querySelectorAll('.filter-btn');
    //     const galeriItems = document.querySelectorAll('.galeri-item');

    //     filterBtns.forEach(btn => {
    //         btn.addEventListener('click', function() {
    //             // Update active button
    //             filterBtns.forEach(b => b.classList.remove('active'));
    //             this.classList.add('active');

    //             const filterValue = this.getAttribute('data-filter');

    //             galeriItems.forEach(item => {
    //                 if (filterValue === 'all') {
    //                     item.style.display = 'block';
    //                     setTimeout(() => {
    //                         item.style.opacity = '1';
    //                         item.style.transform = 'scale(1)';
    //                     }, 10);
    //                 } else {
    //                     if (item.getAttribute('data-category') === filterValue) {
    //                         item.style.display = 'block';
    //                         setTimeout(() => {
    //                             item.style.opacity = '1';
    //                             item.style.transform = 'scale(1)';
    //                         }, 10);
    //                     } else {
    //                         item.style.opacity = '0';
    //                         item.style.transform = 'scale(0.8)';
    //                         setTimeout(() => {
    //                             item.style.display = 'none';
    //                         }, 300);
    //                     }
    //                 }
    //             });
    //         });
    //     });

        // Add transition styles
        galeriItems.forEach(item => {
            item.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        });
    });
</script>
@endpush

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
																												<a href="{{ route("berita.show", $item->slug) }}"
																																style="text-decoration: none; color: inherit;">
																																<div class="shadow-sm card card-berita w-100 h-100">
																																				{{-- Gambar --}}
																																				<img src="{{ asset("storage/" . $item->gambar) }}" class="card-img-top"
																																								alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">

																																				<div class="card-body d-flex flex-column">
																																								{{-- Judul --}}
																																								<h5 class="card-title fw-bold">{{ Str::limit($item->judul, 60) }}</h5>

																																								{{-- Meta info --}}
																																								<p class="mb-2 card-text text-muted small">
																																												<i class="far fa-calendar-alt me-2"></i>
																																												{{ $item->created_at->format("d F Y") }}
																																								</p>

																																								{{-- Badge Kategori --}}
																																								@if ($kat)
																																												<span class="badge {{ $kat["class"] }} px-3 py-2 shadow-sm mb-2">
																																																<i class="{{ $kat["icon"] }} me-1"></i> {{ $kat["nama"] }}
																																												</span>
																																								@else
																																												<span class="px-3 py-2 mb-2 text-white shadow-sm badge bg-secondary">
																																																<i class="fas fa-tag me-1"></i> {{ ucfirst($item->kategori) }}
																																												</span>
																																								@endif

																																								{{-- Ringkasan --}}
																																								<p class="card-text">{{ Str::limit(strip_tags($item->konten), 100) }}</p>

																																								{{-- Tombol --}}
																																								<a href="{{ route("berita.show", $item->slug) }}"
																																												class="mt-auto btn btn-sm btn-primary rounded-pill">
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
																<a href="{{ route("home.daftar-berita") }}" class="px-4 btn btn-outline-primary rounded-pill">
																				<i class="fas fa-book-open me-2"></i> Lihat Semua Berita
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
																				<p class="text-white"><i class="fas fa-map-marker-alt me-2 text-info"></i> Akat Fadedo, Kec. Seram
																								Timur, Kabupaten Seram Bagian Timur, Maluku</p>
																				<p class="text-white"><i class="fas fa-envelope me-2 text-info"></i> admindesa@akatfadedo.com</p>
																				<p class="text-white"><i class="fas fa-phone-alt me-2 text-info"></i> (+62)822-2360-7709</p>
																</div>
												</div>
								</div>
				</section>
@endsection

{{-- Styles Galeri --}}
@push("styles")
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

								@media (max-width: 1200px) {
												.masonry-grid {
																column-count: 3;
												}
								}

								@media (max-width: 768px) {
												.masonry-grid {
																column-count: 2;
												}
								}

								@media (max-width: 576px) {
												.masonry-grid {
																column-count: 1;
												}
								}

								/* Card galeri */
								.galeri-card {
												overflow: hidden;
												border-radius: 12px;
												transition: transform 0.3s ease, box-shadow 0.3s ease;
												cursor: pointer;
								}

								.galeri-card:hover {
												transform: translateY(-5px);
												box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
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

								#galleryModal .btn:hover {
												opacity: 1;
								}

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
												max-width: 900px;
												/* default xl terlalu besar, kita perkecil */
								}

								@media (max-width: 992px) {
												#galleryModal .modal-dialog {
																max-width: 720px;
																/* untuk tablet */
												}
								}

								@media (max-width: 768px) {
												#galleryModal .modal-dialog {
																max-width: 95%;
																/* hampir full di hp */
												}
								}

								#modalImage {
												max-height: 70vh;
												/* biar nggak menutupi layar penuh */
												object-fit: contain;
								}
				</style>
@endpush

{{-- Scripts Galeri --}}

@push("scripts")
				<script>
								const galleryItems = document.querySelectorAll('.img-gallery');
								const modalImage = document.getElementById('modalImage');
								const modalTitle = document.getElementById('modalTitle');
								let currentIndex = 0;

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
								}, {
												threshold: 0.2
								});

								revealElements.forEach(el => observer.observe(el));
				</script>
				<script>
								document.addEventListener('DOMContentLoaded', function() {
												// Deteksi device
												const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator
																.userAgent);
												const isAndroid = /Android/i.test(navigator.userAgent);

												// Handle download APK untuk mobile
												const downloadLinks = document.querySelectorAll('a[href*="download-app"]');

												downloadLinks.forEach(link => {
																link.addEventListener('click', function(e) {
																				if (isMobile && isAndroid) {
																								e.preventDefault();

																								// Buat temporary link dengan attribute download yang tepat
																								const tempLink = document.createElement('a');
																								tempLink.href = this.href;
																								tempLink.download = 'desaku.apk'; // Nama sederhana tanpa version
																								tempLink.style.display = 'none';

																								// Trigger download
																								document.body.appendChild(tempLink);
																								tempLink.click();
																								document.body.removeChild(tempLink);

																								// Show notification
																								if (typeof bootstrap !== 'undefined') {
																												// Jika menggunakan Bootstrap toast
																												showToast('Download dimulai...', 'success');
																								} else {
																												alert('Download dimulai...');
																								}
																				}
																});
												});

												// Function untuk show toast notification
												function showToast(message, type = 'info') {
																// Implementasi toast notification jika diperlukan
																console.log(type + ': ' + message);
												}
								});
				</script>
@endpush

{{-- script Sturuktur Desa --}}
@push("styles")
				<style>
								/* Card Struktur Desa */
								.team-member {
												transition: transform 0.3s ease, box-shadow 0.3s ease;
												background: #fff;
								}

								.team-member:hover {
												transform: translateY(-8px);
												box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
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

								.social-icon.twitter {
												background: #000;
								}

								.social-icon.facebook {
												background: #1877F2;
								}

								.social-icon.instagram {
												background: radial-gradient(circle at 30% 30%, #feda75, #fa7e1e, #d62976, #962fbf, #4f5bd5);
								}

								.social-icon:hover {
												transform: scale(1.15);
												box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
								}
				</style>
@endpush
