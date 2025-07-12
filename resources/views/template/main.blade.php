{{-- resources/views/template/main.blade.php --}}
@include('template.header')

@yield('content')

@include('template.footer')

{{-- Section untuk script tambahan dari halaman child --}}
@yield('scripts')