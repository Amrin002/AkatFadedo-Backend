@extends('layouts.landing')

@section('content')
    <main class="container py-5">
        <h2 class="mb-4 text-center fw-bold">Berita Desa Akat Fadedo</h2>
        <div class="row">
            <div class="text-left my-4">
                <a href="{{ route('home') }}" class="lihat-berita-link">
                    <i class="fas fa-home me-1"></i>Home
                </a>
            </div>
            @forelse ($berita as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <a href="{{ route('berita.show', $item->slug) }}" class="text-dark text-decoration-none">
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top"
                                alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-semibold">{{ \Illuminate\Support\Str::limit($item->judul, 60) }}
                                </h5>
                                <p class="card-text text-muted">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 100) }}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-user"></i> {{ $item->user->name ?? 'Administrator' }}<br>
                                        <i class="fas fa-eye"></i> Dilihat {{ $item->views ?? 0 }} kali
                                    </small>
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 text-end">
                    <span
                        class="badge bg-info text-white">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</span>
                </div>
        </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">Belum ada berita tersedia.</div>
        </div>
        @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="d-flex justify-content-center mt-4">
            {{ $berita->links() }}
        </div>
    </main>
@endsection
