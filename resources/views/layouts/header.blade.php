<!-- Navigasi Bar -->
<nav class="bg-white shadow-sm navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand text-info fw-bold" href="{{ route('home') }}">Desa Akat Fadedo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
       <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/#beranda') }}">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#tentang') }}">Tentang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#potensi') }}">Potensi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#layanan') }}">Layanan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#galeri') }}">Galeri</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('daftar-berita') ? 'active' : '' }}" href="{{ url('/#berita') }}">Berita</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#statistik') }}">Statistik</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#lokasi-desa') }}">Lokasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/#kontak') }}">Kontak</a>
        </li>
    </ul>
</div>

    </div>
</nav>
