@extends('layouts.main')

@section('content')
    <main class="container py-5" style="margin-top:70px; max-width:1200px;">
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center fw-bolder text-dark" style="font-size:2.2rem;">
            Galeri Desa Akat Fadedo
        </h2>

        {{-- Link Kembali ke Home --}}
        <div class="mb-4">
            <a href="{{ route('home') }}" class="text-decoration-none text-info fw-semibold link-home">
                <i class="fas fa-home me-1"></i> Kembali ke Home
            </a>
        </div>

        <div class="row g-4">
            @forelse ($galeri as $index => $item)
                <div class="col-md-4 col-sm-6 reveal">
                    <div class="card galeri-card h-100 border-0 shadow-sm overflow-hidden rounded-3">
                        {{-- Gambar --}}
                        <div class="galeri-img-wrapper">
                            <img src="{{ asset('storage/' . $item->image) }}" 
                                 alt="{{ $item->nama_kegiatan }}" 
                                 class="card-img-top galeri-img img-gallery"
                                 data-index="{{ $index }}"
                                 data-img-src="{{ asset('storage/' . $item->image) }}"
                                 data-title="{{ $item->nama_kegiatan }}">
                        </div>

                        {{-- Judul --}}
                        <div class="card-footer bg-white border-0 text-center">
                            <h5 class="fw-semibold text-dark mb-0">{{ $item->nama_kegiatan }}</h5>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">Belum ada galeri tersedia.</div>
                </div>
            @endforelse
        </div>
        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $galeri->appends(request()->query())->links() }}
        </div>
    </main>

    <!-- Modal Galeri -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark text-white border-0 rounded-4 overflow-hidden shadow-lg">
                <div class="modal-body p-0 position-relative">
                    <!-- Gambar -->
                    <img id="modalImage" src="" alt="Gambar Galeri"
                         class="img-fluid w-100 d-block">

                    <!-- Caption -->
                    <div class="p-3 bg-dark bg-opacity-75 position-absolute bottom-0 start-0 w-100">
                        <h5 id="modalTitle" class="mb-0 fw-semibold text-center"></h5>
                    </div>

                    <!-- Tombol Tutup -->
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
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
@endsection

{{-- styles Galeri --}}
@push('styles')
<style>
    /* Card galeri */
    .galeri-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    .galeri-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .galeri-img-wrapper {
        overflow: hidden;
        border-radius: 8px 8px 0 0;
    }
    .galeri-img {
        height: 250px;
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .galeri-card:hover .galeri-img {
        transform: scale(1.1);
    }

    /* Modal */
    #modalImage {
        max-height: 80vh;
        object-fit: contain;
    }
    #galleryModal .btn {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    #galleryModal .btn:hover {
        opacity: 1;
    }

    /* Animasi reveal */
    .reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
    .reveal.reveal-visible { opacity: 1; transform: none; }
</style>
@endpush

{{-- script Modal Galeri --}}
@push('scripts')
<script>
    const galleryItems = document.querySelectorAll('.img-gallery');
    let currentIndex = 0;

    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const galleryModal = new bootstrap.Modal(document.getElementById('galleryModal'));

    function showImage(index) {
        const img = galleryItems[index];
        modalImage.src = img.dataset.imgSrc;
        modalTitle.textContent = img.dataset.title || 'Galeri';
        currentIndex = index;
        galleryModal.show();
    }

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function () {
            showImage(index);
        });
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + galleryItems.length) % galleryItems.length;
        showImage(currentIndex);
    });

    document.getElementById('nextBtn').addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % galleryItems.length;
        showImage(currentIndex);
    });

    // Animasi scroll reveal
    const revealElements = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('reveal-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    revealElements.forEach(el => observer.observe(el));
</script>
@endpush
