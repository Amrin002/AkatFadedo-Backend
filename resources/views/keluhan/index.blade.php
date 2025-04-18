@extends('template.main')
@section('content')
<div class="container mt-4">
    <h3>Daftar Keluhan</h3>

    <form method="GET" class="mb-3">
        <select name="status" class="form-control w-25 d-inline">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        <button class="btn btn-secondary">Filter</button>
    </form>

    @foreach ($keluhan as $item)
        <div class="card shadow-sm mb-3">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <h5><a href="{{ route('keluhan.show', $item) }}">{{ $item->judul }}</a></h5>
                    <p class="text-muted">{{ Str::limit($item->isi, 100) }}</p>
                    <small>Dikirim oleh: <strong>{{ $item->user->name ?? 'Anonim' }}</strong> - {{ $item->created_at->format('d M Y') }}</small>
                </div>
                <div>
                    <span class="badge 
                        {{ $item->status == 'pending' ? 'bg-warning text-dark' : 
                            ($item->status == 'diproses' ? 'bg-primary' : 'bg-success') }}">
                        {{ ucfirst($item->status) }}
                    </span>

                    @if (auth()->user()->role == 'admin' && $item->status == 'pending')
                        <form action="{{ route('keluhan.tanggapi', $item) }}" method="POST" class="mt-2">
                            @csrf
                            <button class="btn btn-sm btn-outline-primary">Tanggapi</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    @if ($keluhan->isEmpty())
        <div class="alert alert-info">Belum ada keluhan.</div>
    @endif
</div>
@endsection
