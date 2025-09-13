@extends('layouts.main')

@section('content')
    <main class="container py-5" style="margin-top: 70px;"> {{-- ✅ Jeda dari navbar --}}
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center fw-bolder text-dark" style="font-size:2.2rem;">
            Berita Desa Akat Fadedo
        </h2>

        {{-- Link Kembali ke Home --}}
        <div class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none text-info fw-semibold link-home">
                <i class="fas fa-home me-1"></i> Kembali ke Home
            </a>
        </div>

        {{-- Filter Kategori --}}
        <div class="row mb-5">
            <div class="col-md-6">
                <form action="{{ route('home.daftar-berita') }}" method="GET" class="d-flex">
                    <select name="kategori" id="kategori" 
                        class="form-select me-2 shadow-sm rounded-pill"
                        onchange="this.form.submit()">
                        <option value="">-- Semua Kategori --</option>
                        @foreach ($kategoriData as $kat)
                            <option value="{{ $kat['nama'] }}" 
                                {{ request('kategori') == $kat['nama'] ? 'selected' : '' }}>
                                {{ $kat['nama'] }}
                            </option>
                        @endforeach
                    </select>
                    @if (request('kategori'))
                        <a href="{{ route('home.daftar-berita') }}" 
                           class="btn btn-outline-secondary rounded-pill shadow-sm">Reset</a>
                    @endif
                </form>
            </div>
        </div>

        {{-- Daftar Berita --}}
        <div class="row">
            @forelse ($berita as $item)
                <div class="col-md-4 mb-4">
                    <div class="card berita-card h-100 border-0 shadow-sm rounded-3 overflow-hidden">
                        {{-- Gambar Berita --}}
                        <a href="{{ route('berita.show', $item->slug) }}" class="berita-img-link">
                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                 alt="{{ $item->judul }}"
                                 class="card-img-top berita-img"
                                 style="height: 220px; object-fit: cover;">
                        </a>

                        <div class="card-body d-flex flex-column">
                            {{-- Judul --}}
                            <h5 class="card-title fw-bold text-dark berita-title">
                                {{ \Illuminate\Support\Str::limit($item->judul, 60) }}
                            </h5>

                            {{-- Ringkasan --}}
                            <p class="card-text text-muted" style="font-size:0.9rem;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 100) }}
                            </p>

                            {{-- Tombol Baca --}}
                            <a href="{{ route('berita.show', $item->slug) }}"
                               class="btn btn-info btn-sm text-white rounded-pill mt-auto align-self-start">
                                <i class="fas fa-book-open me-1"></i> Baca Selengkapnya
                            </a>
                        </div>

                       {{-- Footer Card --}}
<div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
    {{-- Tanggal --}}
    <span class="badge bg-info text-white shadow-sm">
        <i class="far fa-calendar-alt me-1"></i>
        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
    </span>

    {{-- Kategori --}}
    @php $kat = $kategoriData[strtolower($item->kategori)] ?? null; @endphp
    @if ($kat)
        <span class="badge {{ $kat['class'] }} shadow-sm">
            <i class="{{ $kat['icon'] }} me-1"></i> {{ $kat['nama'] }}
        </span>
    @endif
</div>

                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Belum ada berita tersedia.</div>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $berita->appends(request()->query())->links() }}
        </div>
    </main>
@endsection

@push('styles')
<style>
    /* Hover efek untuk card */
    .berita-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .berita-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    /* Hover zoom gambar */
    .berita-img {
        transition: transform 0.4s ease;
    }
    .berita-card:hover .berita-img {
        transform: scale(1.05);
    }

    /* Judul berita */
    .berita-title {
        font-size: 1.05rem;
        min-height: 55px;
        transition: color 0.3s ease;
    }
    .berita-title:hover {
        color: #0d6efd;
    }

    /* Link home hover */
    .link-home {
        transition: color 0.3s ease, text-shadow 0.3s ease;
    }
    .link-home:hover {
        color: #0d6efd;
        text-shadow: 0px 1px 5px rgba(0,0,0,0.2);
    }
</style>
@endpush
