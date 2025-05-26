@extends('template.main')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="fw-bold">{{ $keluhan->judul }}</h3>
            <p class="mt-3">{{ $keluhan->isi }}</p>

            <hr>

            <p>
                <strong>Status:</strong>
                <span class="badge 
                    {{ $keluhan->status == 'pending' ? 'bg-warning text-dark' : 
                        ($keluhan->status == 'diproses' ? 'bg-primary' : 'bg-success') }}">
                    {{ ucfirst($keluhan->status) }}
                </span>
            </p>

            <p>
                <strong>Dikirim oleh:</strong> {{ $keluhan->user->name ?? 'Anonim' }} <br>
                <strong>Dibuat:</strong> {{ $keluhan->created_at->format('d M Y H:i') }} <br>
            </p>

            @if($keluhan->respon_admin)
                <hr>
                <h5 class="text-primary fw-bold">Tanggapan Admin</h5>
                <p>{{ $keluhan->respon_admin }}</p>
            @endif

            @if($keluhan->tanggal_diproses)
                <p><strong>Tanggal Diproses:</strong> {{ $keluhan->tanggal_diproses->format('d M Y H:i') }}</p>
            @endif

            @if($keluhan->tanggal_selesai)
                <p><strong>Tanggal Selesai:</strong> {{ $keluhan->tanggal_selesai->format('d M Y H:i') }}</p>
            @endif

            <a href="{{ route('keluhan.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Keluhan
            </a>
        </div>
    </div>
</div>
@endsection
