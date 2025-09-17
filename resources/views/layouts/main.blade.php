<!doctype html>
<html lang="id">

<head>
    <!-- Meta tags wajib -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        xintegrity="sha512-SnH5WK+bZxgPHs44uWp/i9Fw9z9c1F1+c1a2d1e+4y5K5z5F5z5+1z5b5b5c5d5e5f5g5h5i5j5k5l5m5n5o5p5q5r5s5t5u5v5w5x5y5z5A5B5C5D5E5F5G5H5I5J5K5L5M5N5O5P5Q5R5S5T5U5V5W5X5Y5Z5a5b5c5d5e5f5g5h5i5j5k5l5m5n5o5p5q5r5s5t5u5v5w5x5y5z5"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo2.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo2.png') }}">

    <!-- Favicon untuk berbagai ukuran -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo2.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo2.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo2.png') }}">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <title>Website Resmi Desa Akat Fadedo</title>
    <meta name="description"
        content="Website resmi Desa Akat Fadedo, Kecamatan Seram Timur, Kabupaten Seram Bagian Timur, menyajikan informasi lengkap tentang profil desa, sejarah, serta struktur pemerintahan desa. Melalui situs ini, Anda dapat mengenal lebih dekat kehidupan masyarakat Desa Akat Fadedo, serta berbagai potensi yang ada di desa ini. Temukan informasi mengenai program-program pembangunan dan kegiatan yang berlangsung di desa yang penuh dengan nilai sejarah dan budaya lokal.">
    <meta name="keywords"
        content="Akat Fadedo, Desa Akat Fadedo, desa akat fadedo, akat fadedo,  Akat Fadedo Website, Website Desa, Seram timur, Seram Bagian Timur, SBT, desa akat fadedo, akar fadedo, desa akar fadedo, sejarah desa akat fadedo, profil desa akat fadedo, pemerintahan desa akat fadedo, kepala desa akat fadedo, BPD akat fadedo, RT RW akat fadedo, penduduk akat fadedo, demografi akat fadedo, wisata akat fadedo, potensi desa akat fadedo, ekonomi akat fadedo, pertanian akat fadedo, perikanan akat fadedo, UMKM akat fadedo, budaya akat fadedo, adat istiadat akat fadedo, tradisi akat fadedo, seram bagian timur, kabupaten seram bagian timur, provinsi maluku, desa di maluku, desa di seram, pulau seram, kecamatan seram timur, pemerintah desa, pelayanan publik, administrasi desa, data desa, statistik desa, program desa, pembangunan desa, dana desa, APBDes, BUMDes, posyandu, PKK, karang taruna, lembaga desa">
    <!-- Meta tags tambahan untuk SEO -->
    <meta name="author" content="Pemerintah Desa Akat Fadedo">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="geo.region" content="ID-ML">
    <meta name="geo.placename" content="Akat Fadedo, Seram Timur, Seram Bagian Timur">

    <!-- Open Graph Meta Tags untuk media sosial -->
    <meta property="og:title" content="Desa Akat Fadedo - Website Resmi">
    <meta property="og:description"
        content="Website resmi Desa Akat Fadedo, Kecamatan Seram Timur, Kabupaten Seram Bagian Timur. Informasi lengkap tentang profil desa, sejarah, pemerintahan, dan potensi wisata.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://akatfadedo.com">
    <meta property="og:image" content="{{ asset('landing/assets/img/Logo2.png') }}">
    <meta property="og:site_name" content="Akat Fadedo">
    <meta property="og:locale" content="id_ID">
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Desa Akat Fadedo - Website Resmi">
    <meta name="twitter:description"
        content="Website resmi Desa Akat Fadedo, Kecamatan Seram Timur, Kabupaten Seram Bagian Timur.">
    <meta name="twitter:image" content="{{ asset('landing/assets/img/Logo2.png') }}">

    <!-- Meta tags khusus untuk desa -->
    <meta name="dc.title" content="Desa Akat Fadedo">
    <meta name="dc.subject" content="Pemerintahan Desa, Pelayanan Publik, Informasi Desa">
    <meta name="dc.creator" content="Pemerintah Desa Akat Fadedo">
    <meta name="dc.publisher" content="Pemerintah Desa Akat Fadedo">
    <meta name="dc.type" content="Text">
    <meta name="dc.format" content="text/html">
    <meta name="dc.language" content="id">
    <meta name="dc.coverage" content="Akat Fadedo, Seram Bagian Timur, Maluku Tengah, Indonesia".>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">


    <style>
        /* ====================
            CSS Global
            ==================== */
        :root {
            --bs-blue: #3FBBC0;
            --bs-blue-rgb: 63, 187, 192;
        }

        .btn-primary,
        .bg-primary,
        .text-primary,
        .border-primary {
            --bs-btn-bg: #0DCAF0;
            --bs-btn-border-color: #0DCAF0;
            --bs-btn-hover-bg: #217378;
            --bs-btn-hover-border-color: #217378;
            --bs-btn-active-bg: #217378;
            --bs-btn-active-border-color: #217378;
            --bs-btn-disabled-bg: #0DCAF0;
            --bs-btn-disabled-border-color: #0DCAF0;
        }

        .text-justify-custom {
            text-align: justify;
        }

        .btn-outline-primary {
            --bs-btn-color: #0DCAF0;
            --bs-btn-border-color: #0DCAF0;
            --bs-btn-hover-bg: #0DCAF0;
            --bs-btn-hover-border-color: #0DCAF0;
            --bs-btn-active-bg: #0DCAF0;
            --bs-btn-active-border-color: #0DCAF0;
            --bs-btn-disabled-color: #0DCAF0;
            --bs-btn-disabled-border-color: #0DCAF0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            scroll-behavior: smooth;
        }

        .section-title {
            position: relative;
            font-weight: 700;
            padding-bottom: 1rem;
            margin-bottom: 3rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: #3FBBC0;
        }

        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .reveal-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .navbar-brand,
        .nav-link {
            transition: color 0.3s ease;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #28b33f !important;
        }
    </style>
    @stack('styles')
</head>

<body data-bs-spy="scroll" data-bs-target="#navbarNav" data-bs-offset="100">
    @include('layouts.header')
    @yield('content')
    <!-- Footer -->
    <footer class="py-4 bg-info text-primary">
        <div class="container text-center">
            <p class="mb-0 text-muted">&copy; 2025 Desa Akat Fadedo. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
