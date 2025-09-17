@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <div class="card shadow-lg border-0">
                        <div class="card-body">
                            <h2 class="mb-4 text-center text-primary fw-bold">
                                📣 Detail Keluhan Masyarakat
                            </h2>

                            <h4 class="fw-bold text-dark mb-3">
                                {{ $keluhan->judul }}
                            </h4>

                            @if ($keluhan->gambar)
                                <div class="text-center mb-4">
                                    <img src="{{ asset('storage/' . $keluhan->gambar) }}" alt="Gambar Keluhan"
                                        class="img-fluid rounded" style="max-width: 500px;">
                                </div>
                            @endif

                            <p class="text-justify" style="font-size: 1.1rem;">
                                {!! nl2br(e($keluhan->isi)) !!}
                            </p>

                            <hr class="my-4">

                            <div class="mb-3">
                                <strong>Status:</strong>
                                <span
                                    class="badge 
                                    {{ $keluhan->status == 'pending'
                                        ? 'bg-warning text-dark'
                                        : ($keluhan->status == 'diproses'
                                            ? 'bg-primary'
                                            : 'bg-success') }}">
                                    {{ ucfirst($keluhan->status) }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <strong>Pengirim:</strong> {{ $keluhan->user->name ?? 'Anonim' }} <br>
                                <strong>Dikirim Pada:</strong> {{ $keluhan->created_at->setTimezone('Asia/Jayapura')->format('d M Y H:i') }}
                            </div>

                            @if ($keluhan->status !== 'pending')
                                <hr>
                                <div class="bg-light p-3 rounded mb-3">
                                    <h5 class="fw-bold text-primary mb-2">🛠️ Tanggapan dari Admin</h5>
                                    <p>"{!! nl2br(e($keluhan->respon_admin ?? '-')) !!}"</p>

                                    @if ($keluhan->tanggal_diproses)
                                        <p><strong>Tanggal Diproses:</strong>
                                            {{ \Carbon\Carbon::parse($keluhan->tanggal_diproses)->setTimezone('Asia/Jayapura')->format('d M Y H:i') }}
                                        </p>
                                    @endif

                                    @if ($keluhan->tanggal_selesai)
                                        <p><strong>Tanggal Selesai:</strong>
                                            {{ \Carbon\Carbon::parse($keluhan->tanggal_selesai)->setTimezone('Asia/Jayapura')->format('d M Y H:i') }}
                                        </p>
                                    @endif
                                </div>
                            @endif

                            <a href="{{ route('keluhan.index') }}" class="btn btn-outline-secondary mt-3">
                                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Keluhan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
