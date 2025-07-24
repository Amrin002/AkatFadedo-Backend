{{-- resources/views/template/main.blade.php --}}
@include('template.header')

@yield('content')

@include('template.footer')


@stack('scripts')

{{-- Section untuk script tambahan dari halaman child --}}
@yield('scripts')