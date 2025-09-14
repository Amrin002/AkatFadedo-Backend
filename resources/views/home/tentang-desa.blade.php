@extends('layouts.main')
@push('styles')
    <style>
        .hero-section {
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('{{ asset('landing/assets/img/hero-carousel/hero-carousel.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .section-title {
            color: #2c3e50;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .text-justify-custom {
            text-align: justify;
            line-height: 1.7;
        }

        .reveal {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.6s ease;
        }

        .card-text {
            font-size: 1rem;
            line-height: 1.6;
        }

        .breadcrumb a {
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .map-container {
            position: relative;
            width: 100%;
            height: 400px;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .geographic-info {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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

        .border-item {
            padding: 0.25rem 0;
            margin-left: 2rem;
            border-left: 3px solid #17a2b8;
            padding-left: 1rem;
            margin-bottom: 0.5rem;
        }

        .village-image {
            border-radius: 1rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .village-image:hover {
            transform: translateY(-5px);
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 50vh;
                padding: 2rem 0;
            }

            .hero-section h1 {
                font-size: 2rem;
            }

            .map-container {
                height: 300px;
                margin-bottom: 2rem;
            }

            .geographic-info {
                padding: 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section Tentang Desa -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="text-center col-lg-8">
                    <h1 class="mb-4 display-4 fw-bold">Tentang Desa Akat Fadedo</h1>
                    <p class="mb-5 lead fs-5">Kenali desa Akat Fadedo lebih dekat</p>
                    <nav aria-label="breadcrumb">
                        <ol class="mb-0 breadcrumb justify-content-center">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-white">Beranda</a>
                            </li>
                            <li class="text-white breadcrumb-item active" aria-current="page">
                                Tentang Desa
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Tentang Desa -->
    <section class="py-5 my-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 reveal">
                    <div class="position-relative">
                        <img src="{{ asset('landing/assets/img/ProfilDesa.jpg') }}"
                             alt="Profil Desa Akat Fadedo"
                             class="village-image img-fluid w-100"
                             loading="lazy">
                    </div>
                </div>
                <div class="col-lg-6 reveal">
                    <h2 class="mb-4 text-center section-title text-lg-start">Tentang Desa Akat Fadedo</h2>

                    <div class="mb-4">
                        <h5 class="mb-3 fw-bold">Visi Desa</h5>
                        <p class="text-justify-custom fs-6">
                            Terwujudnya Masyarakat Desa Akat Fadedo yang Religius, Cerdas, Maju, Sehat Dan Sejahtera.
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5 class="mb-3 fw-bold">Sejarah Desa</h5>
                        <p class="card-text text-justify-custom">
                            Akat Fadedo sudah ada sejak jaman dulu namun penghuni pertama hanya 4 keluarga dan
                            Fadedo masih kategori dusun dari Negeri Urung. (Anak Dusun Desa Urung).
                        </p>
                        <p class="card-text text-justify-custom">
                            Seiring dengan perkembangan zaman pertumbuhan penduduk pun mulai bertambah. Setelah Seram Bagian
                            Timur mekar dari Maluku Tengah pada tahun 2003, Pemerintah SBT mulai melakukan pemekaran Kecamatan
                            dari 5 Kecamatan menjadi 15 Kecamatan. Dusun-dusun di SBT pun ambil bagian di pemekaran tersebut,
                            salah satunya dusun Akat Fadedo yang dimekarkan pada tahun 2014 menjadi sebuah Desa Administratif.
                        </p>
                        <p class="card-text text-justify-custom">
                            Dan sampai saat ini Desa Administratif Akat Fadedo telah dipimpin oleh 3 Pejabat Kepala Pemerintahan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bagian Lokasi Desa -->
    <section class="py-5 my-5 bg-light">
        <div class="container">
            <div class="mb-5 row justify-content-center">
                <div class="text-center col-lg-8">
                    <h2 class="section-title">Peta & Wilayah Desa</h2>
                    <p class="lead text-muted">Informasi geografis dan batas wilayah Desa Akat Fadedo</p>
                </div>
            </div>

            <div class="row g-4 reveal">
                <div class="mb-4 col-lg-6 mb-lg-0">
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1442.3112557462064!2d130.71061032854638!3d-3.8241932616395586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d40810037fec673%3A0x4407ad62fb3b89d6!2sKantor%20Desa%20Akat%20Fadedo!5e1!3m2!1sid!2sid!4v1738774423050!5m2!1sid!2sid"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Peta Lokasi Desa Akat Fadedo">
                        </iframe>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="geographic-info h-100">
                        <h5 class="mb-4 fw-bold text-dark">Informasi Geografis</h5>
                        <div class="info-item">
                            <i class="fas fa-map-marked-alt me-2 text-info"></i>
                            <div>
                                <strong>Luas Wilayah:</strong> 15.000 km²
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
                                Desa Akat Fadedo memiliki topografi yang bervariasi, didominasi oleh dataran
                                rendah dan perbukitan yang subur, ideal untuk pertanian dan perkebunan.
                                Ketinggiannya berkisar antara 100 hingga 300 meter di atas permukaan laut.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Menggunakan fungsi reveal yang sudah ada di layout global
    document.addEventListener('DOMContentLoaded', function() {
        // Animation on scroll menggunakan sistem yang sudah ada
        const revealElements = document.querySelectorAll('.reveal');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endpush
