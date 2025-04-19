@extends('template.main')
@section('content')
<div>
    <h3>Kirim Keluhan Baru</h3>

    <form action="{{ route('keluhan.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="judul">Judul Keluhan</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="isi">Isi Keluhan</label>
            <textarea name="isi" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection
