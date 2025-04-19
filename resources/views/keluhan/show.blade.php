@extends('template.main')
@section('content')
<div>
    <h3>{{ $keluhan->judul }}</h3>
    <p>{{ $keluhan->isi }}</p>

    <p><strong>Status:</strong>
        <span class="badge 
            {{ $keluhan->status == 'pending' ? 'bg-warning text-dark' : 
                ($keluhan->status == 'diproses' ? 'bg-primary' : 'bg-success') }}">
            {{ ucfirst($keluhan->status) }}
        </span>
    </p>
    <small>Dikirim oleh: {{ $keluhan->user->name ?? 'Anonim' }} - {{ $keluhan->created_at->diffForHumans() }}</small>
</div>
@endsection
