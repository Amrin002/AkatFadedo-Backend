@extends('layouts.landing')

<style>
    .a4-preview {
        width: 100%;
        min-height: 400px;
        margin-bottom: 20px;
        background-color: #f8f9fa;
        border: 2px dashed #ccc;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .a4-preview p {
        margin: 0;
        color: #999;
    }

    .info-card {
        display: flex;
        align-items: center;
        background-color: #f8f9fa;
        border-radius: 0 40px 40px 0;
        /* hanya sisi kanan yang bulat */
        margin-bottom: 15px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .info-icon {
        background-color: #44b4e8;
        /* bisa diganti sesuai kebutuhan */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
        border-radius: 0;
        /* sisi kiri tetap kotak */
    }

    .info-icon img {
        width: 60px;
        height: 70px;
        object-fit: contain;
    }

    .info-content {
        padding: 10px 20px;
        flex-grow: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-title {
        margin-left: -10px;
        font-weight: 600;
        font-size: 10pt
    }

    .info-amount {
        font-weight: bold;
        white-space: nowrap;
    }

    .icon-img {
        width: 50px;
        height: 50px;
    }

    .font {
        font-family: 'Poppins', sans-serif;
    }
</style>

@section('content')
    <div class="container mt-4 font">
        <form method="GET" action="{{ route('apbdes.viewUser') }}">
            <div class="container mt-3">
                <div class="row" style="margin-left:0px">
                    <div class="col-md-3">
                        <div class="input-group shadow-sm rounded">
                            <span class="input-group-text bg-primary text-white">
                                <i class="bi bi-funnel-fill"></i>
                            </span>
                            <select name="tahun" class="form-select border-0" onchange="this.form.submit()">
                                @foreach ($daftarTahun as $tahun)
                                    <option value="{{ $tahun }}" {{ $tahunDipilih == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- Hanya tampilkan jika tahun dipilih --}}
        @if (count($apbdes) > 0)
            <div class="container mt-4">
                {{-- looping card bidang --}}
                @foreach ($apbdes as $item)
                    {{-- tampilkan card di sini --}}
                    <div class="container font" style="margin-top:30px">
                        <h2 class="fw-bold text-center mb-4">APBDes {{ $item->tahun }} Negeri Akat Fadedo</h2>
                        <div class="row">
                            <!-- (Konten seperti biasa tetap di sini) -->
                            <!-- Kolom Kiri: Card List -->
                            <div class="col-md-7">
                                <div class="info-card">
                                    <div class="info-icon" style="background-color: #33a1d4;">
                                        <img src="{{ asset('images/stats.png') }}">
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Pendapatan</div>
                                        <div class="info-amount">Rp {{ number_format($item->pendapatan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-card">
                                    <div class="info-icon" style="background-color: #007db8;">
                                        <img src="{{ asset('images/townhall.png') }}">
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Bidang Penyelenggaraan Pemerintahan Desa</div>
                                        <div class="info-amount">Rp {{ number_format($item->penyelenggaraan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-card">
                                    <div class="info-icon" style="background-color: #006a9b;">
                                        <img src="{{ asset('images/excavator.png') }}">
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Bidang Pelaksanaan Pembangunan Desa</div>
                                        <div class="info-amount">Rp {{ number_format($item->pelaksanaan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-card">
                                    <div class="info-icon" style="background-color: #005177;">
                                        <img src="{{ asset('images/teach.png') }}">
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Bidang Pembinaan Kemasyarakatan</div>
                                        <div class="info-amount">Rp {{ number_format($item->pembinaan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-card">
                                    <div class="info-icon" style="background-color: #013d59;">
                                        <img src="{{ asset('images/people.png') }}">
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Bidang Pemberdayaan Masyarakat</div>
                                        <div class="info-amount">Rp {{ number_format($item->pemberdayaan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-card">
                                    <div class="info-icon" style="background-color: #002232;">
                                        <img src="{{ asset('images/tsunami.png') }}">
                                    </div>
                                    <div class="info-content">
                                        <div class="info-title">Bidang Penanggulangan Bencana, Darurat dan Mendesak</div>
                                        <div class="info-amount">Rp {{ number_format($item->penanggulangan, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>

                                <div
                                    style="
                                background-image: url('{{ asset('images/profile_frame.png') }}');
                                background-repeat: no-repeat;
                                background-position: center;
                                background-size: 100% auto;
                                border-radius: 12px;
                                width: 100%;
                                max-width: 400px;
                                height: 180px;
                                margin: 30px auto;
                                padding: 15px 20px;
                                display: flex;
                                align-items: center;
                                justify-content: space-between;
                                flex-wrap: nowrap;
                            ">
                                    <!-- Kolom kiri: Logo -->
                                    <div style="flex-shrink: 0; margin-left: 20px;">
                                        <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="img-fluid"
                                            style="max-height: 120px;">
                                    </div>

                                    <!-- Kolom kanan: Teks -->
                                    <div class="text-end text-dark ms-2" style="flex: 1;">
                                        <p class="mb-1" style="font-size: 16px; text-shadow: 1px 1px 2px #3b3b3b;">Pejabat
                                            Kepala Desa</p>
                                        <p class="mb-5" style="font-size: 18px; text-shadow: 1px 1px 2px #3b3b3b;">
                                            {{ $item->pejabat }}</p>
                                        <p class="mb-0" style="font-size: 20px; text-shadow: 1px 1px 2px #3b3b3b;">Akat
                                            Fadedo</p>
                                    </div>
                                </div>

                                <style>
                                    @media (max-width: 576px) {
                                        div[style*="background-image"] {
                                            height: 150px !important;
                                            padding: 20px 10px !important;
                                        }

                                        div[style*="background-image"] img {
                                            max-height: 110px !important;
                                        }

                                        div[style*="background-image"] p {
                                            font-size: 16px !important;
                                        }
                                    }
                                </style>
                            </div>

                            <!-- Kolom Kanan: Gambar Besar -->
                            <div class="col-md-5 d-flex justify-content-center">
                                <div class="a4-preview" role="button" data-bs-toggle="modal"
                                    data-bs-target="#modalGambar{{ $item->id }}">
                                    <img src="{{ asset('storage/' . $item->file) }}" alt="Gambar APBDes" class="img-fluid"
                                        onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';">
                                </div>

                                <!-- Modal Full Gambar -->
                                <div class="modal fade" id="modalGambar{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content bg-transparent border-0">
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/' . $item->file) }}"
                                                    alt="Gambar APBDes Full" class="img-fluid rounded shadow"
                                                    onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="container text-center mt-5 mb-5">
                <img src="{{ asset('images/no_data.png') }}" alt="Data kosong" style="max-width: 400px;"
                    class="mb-3">
                <h4 class="text-muted">Maaf, data APBDes belum tersedia.</h4>
            </div>
        @endif
    </div>
@endsection
