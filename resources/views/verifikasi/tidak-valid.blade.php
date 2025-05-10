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
                                <div class="verification-icon bg-danger text-white rounded-circle mx-auto"
                                    style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center; font-size: 40px;">
                                    <i class="bi bi-x-lg"></i>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="verification-info text-center">
                                        <h4 class="fw-bold text-danger mb-3">DOKUMEN TIDAK VALID</h4>
                                        <p class="mb-4">Maaf, dokumen yang Anda coba verifikasi tidak ditemukan atau sudah
                                            tidak berlaku.</p>

                                        <div class="alert alert-warning" role="alert">
                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                            Kemungkinan penyebab dokumen tidak valid:
                                            <ul class="text-start mt-2 mb-0">
                                                <li>Dokumen telah dibatalkan oleh pihak desa</li>
                                                <li>Masa berlaku dokumen telah habis</li>
                                                <li>Kode QR atau token verifikasi tidak terdaftar</li>
                                                <li>Dokumen sedang dalam proses perubahan status</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="verification-info">
                                        <h5 class="fw-bold mb-3">Informasi</h5>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Waktu Pemeriksaan</div>
                                            <div class="col-md-8">
                                                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y, HH:mm:ss') }}
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Status</div>
                                            <div class="col-md-8">
                                                <span class="badge bg-danger">TIDAK VALID</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-4">
                                        <p class="mb-2">Untuk penjelasan lebih lanjut, silahkan menghubungi Kantor Desa
                                            Akat Fadedo</p>
                                        <a href="{{ route('home') }}" class="btn btn-primary mt-3">
                                            <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
                                        </a>
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
