@extends('layouts.landing')

@section('content')
    <section id="verification" class="verification section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="row mb-4">
                                <div class="col-12 text-center">
                                    <img src="{{ asset('landing/assets/img/Logo2.png') }}" alt="Logo Desa"
                                        style="max-height: 80px;">
                                    <h4 class="mt-3 fw-bold">VERIFIKASI DOKUMEN RESMI</h4>
                                    <h5>Desa Akat Fadedo</h5>
                                </div>
                            </div>

                            <div class="text-center mb-4">
                                @if ($verifikasi->status == 'Approve' || $verifikasi->status == 'TERVERIFIKASI')
                                    <div class="verification-icon bg-success text-white rounded-circle mx-auto"
                                        style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; font-size: 40px;">
                                        <i class="bi bi-check-lg"></i>
                                    </div>
                                @else
                                    <div class="verification-icon bg-danger text-white rounded-circle mx-auto"
                                        style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; font-size: 40px;">
                                        <i class="bi bi-x-lg"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="verification-info">
                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Status dokumen</div>
                                            <div class="col-md-8">
                                                @if ($verifikasi->status == 'Approve' || $verifikasi->status == 'TERVERIFIKASI')
                                                    <span class="badge bg-success">TERVERIFIKASI</span>
                                                @else
                                                    <span class="badge bg-danger">TIDAK AKTIF</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">No. Surat</div>
                                            <div class="col-md-8">
                                                {{ $verifikasi->no_surat ?? $verifikasi->nomor_surat }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Nama Pemohon</div>
                                            <div class="col-md-8">
                                                {{ $verifikasi->nama ?? $verifikasi->nama_pemohon }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Jenis Surat</div>
                                            <div class="col-md-8">
                                                @if (isset($verifikasi->type_surat))
                                                    {{ $verifikasi->type_surat }}
                                                @elseif (get_class($verifikasi) == 'App\Models\SuratKtm')
                                                    SURAT KETERANGAN TIDAK MAMPU
                                                @elseif(get_class($verifikasi) == 'App\Models\SuratDomisili')
                                                    SURAT KETERANGAN DOMISILI
                                                @elseif(get_class($verifikasi) == 'App\Models\SuratPindah')
                                                    SURAT KETERANGAN PINDAH
                                                @elseif(get_class($verifikasi) == 'App\Models\SuratKtu')
                                                    SURAT KETERANGAN USAHA
                                                @else
                                                    {{ class_basename(get_class($verifikasi)) }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="verification-info">
                                        <h5 class="fw-bold mb-3">Informasi</h5>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Tanggal Terbit</div>
                                            <div class="col-md-8">
                                                {{ \Carbon\Carbon::parse($verifikasi->tanggal_terbit)->locale('id')->isoFormat('D MMMM Y') }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Penandatanganan</div>
                                            <div class="col-md-8">
                                                Muhamad Arsad Talahatu
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Waktu Verifikasi</div>
                                            <div class="col-md-8">
                                                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('HH:mm:ss') }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Dikeluarkan oleh</div>
                                            <div class="col-md-8">
                                                Kantor Desa Akat Fadedo
                                            </div>
                                        </div>



                                    </div>


                                    <div class="text-center mt-4">
                                        <p class="mb-0">Untuk penjelasan lebih lanjut, silahkan menghubungi Kantor Desa
                                            Akat Fadedo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
