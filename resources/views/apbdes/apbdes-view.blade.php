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
        border-radius: 0 40px 40px 0; /* hanya sisi kanan yang bulat */
        margin-bottom: 15px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .info-icon {
        width: 60px;
        height: 70px;
        background-color: #44b4e8; /* bisa diganti sesuai kebutuhan */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
        border-radius: 0; /* sisi kiri tetap kotak */
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

    .font{
        font-family: 'Poppins', sans-serif;
    }

</style>

@section('content')
<div class="container mt-4 font">
    <form method="GET" action="{{ route('apbdes.viewUser') }}">
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-4">
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
    @if ($apbdes->count() > 0)
        <div class="container mt-4">
            {{-- looping card bidang --}}
            @foreach ($apbdes as $item)
                {{-- tampilkan card di sini --}}
                <div class="container mt-4 font">
                    <h2 class="fw-bold text-center mb-4">APBDes {{ $item->tahun }} Negeri Akad Fadedo</h2>
                    <div class="row">
                        <!-- Kolom Kiri: Card List -->
                        <div class="col-md-7">
                            <div class="info-card">
                                <div class="info-icon" style="background-color: #007db8;">
                                    <img src="/images/townhall.png" class="icon-img" alt="icon">
                                </div>
                                <div class="info-content">
                                    <div class="info-title">Bidang Penyelenggaraan Pemerintahan Desa</div>
                                    <div class="info-amount">Rp {{ number_format($item->penyelenggaraan, 0, ',', '.') }}</div>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon" style="background-color: #006a9b;">
                                    <img src="/images/excavator.png" class="icon-img" alt="icon">
                                </div>
                                <div class="info-content">
                                    <div class="info-title">Bidang Pelaksanaan Pembangunan Desa</div>
                                    <div class="info-amount">Rp {{ number_format($item->pelaksanaan, 0, ',', '.') }}</div>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon" style="background-color: #005177;">
                                    <img src="/images/teach.png" class="icon-img" alt="icon">
                                </div>
                                <div class="info-content">
                                    <div class="info-title">Bidang Pembinaan Kemasyarakatan</div>
                                    <div class="info-amount">Rp {{ number_format($item->pembinaan, 0, ',', '.') }}</div>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon" style="background-color: #013d59;">
                                    <img src="/images/people.png" class="icon-img" alt="icon">
                                </div>
                                <div class="info-content">
                                    <div class="info-title">Bidang Pemberdayaan Masyarakat</div>
                                    <div class="info-amount">Rp {{ number_format($item->pemberdayaan, 0, ',', '.') }}</div>
                                </div>
                            </div>

                            <div class="info-card">
                                <div class="info-icon" style="background-color: #002232;">
                                    <img src="/images/tsunami.png" class="icon-img" alt="icon">
                                </div>
                                <div class="info-content">
                                    <div class="info-title">Bidang Penanggulangan Bencana, Darurat dan Mendesak</div>
                                    <div class="info-amount">Rp {{ number_format($item->penanggulangan, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Gambar Besar -->
                        <div class="col-md-5 d-flex justify-content-center">
                            @if ($item->file && file_exists(public_path('storage/' . $item->file)))
                                <div class="a4-preview" role="button" data-bs-toggle="modal" data-bs-target="#modalGambar{{ $item->id }}">
                                    <img src="{{ asset('storage/' . $item->file) }}" alt="Gambar APBDes" class="img-fluid">
                                </div>

                                <!-- Modal Full Gambar -->
                                <div class="modal fade" id="modalGambar{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content bg-transparent border-0">
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/' . $item->file) }}" alt="Gambar APBDes Full" class="img-fluid rounded shadow">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="a4-preview">
                                    <p>Placeholder A4</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
