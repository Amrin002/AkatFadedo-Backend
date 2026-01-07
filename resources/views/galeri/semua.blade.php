@extends('layouts.main')

@section('content')
<div class="container py-5" style="margin-top:70px; max-width:1200px;">

    @php
        $kegiatan = $galeri->first()->kegiatan ?? null;
    @endphp

    {{-- Judul & Deskripsi Kegiatan --}}
    <div class="mb-4 text-center">
        <h3 class="fw-bold mb-2">
            {{ $kegiatan->judul ?? 'Galeri Kegiatan' }}
        </h3>

        @if ($kegiatan && $kegiatan->deskripsi)
            <p class="text-muted mb-1">
                {{ $kegiatan->deskripsi }}
            </p>
        @endif

        @if ($kegiatan && $kegiatan->tanggal)
            <p class="text-muted small">
                <i class="far fa-calendar-alt me-1"></i>
                {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d F Y') }}
            </p>
        @endif
    </div>

    {{-- Grid Galeri --}}
    <div class="row g-3">
        @foreach ($galeri as $item)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card shadow-sm h-100 border-0">
                    <img src="{{ asset('storage/' . $item->image) }}"
                         class="card-img-top"
                         style="height:220px; object-fit:cover">

                    {{-- Nama Foto --}}
                    @if ($item->nama_kegiatan)
                        <div class="card-body py-2 text-center">
                            <p class="mb-0 small fw-semibold">
                                {{ Str::limit($item->nama_kegiatan, 40) }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-4 d-flex justify-content-center">
        {{ $galeri->links() }}
    </div>

</div>
@endsection
