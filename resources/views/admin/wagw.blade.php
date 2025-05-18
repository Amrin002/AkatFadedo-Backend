@extends('template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="container-fluid">
                <form action="{{ route('wagw/send') }}" method="post">
                    @csrf
                    <input type="text" name="pesan" placeholder="pesan">
                    <input type="text" name="nowa" placeholder="now">
                    <button type="button" class="btn btn-primary"></button>
                </form>
            </div>
        </div>
    </div>
@endsection
