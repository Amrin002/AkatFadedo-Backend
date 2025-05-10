@extends('template.main')
@section('title', 'Riwayat Verifikasi Surat')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Riwayat Verifikasi Surat</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Riwayat Verifikasi</h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Filter dan Pencarian -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <form action="{{ route('verifikasi.index') }}" method="GET" class="form-inline">
                                        <div class="form-group mr-2">
                                            <select name="type_surat" class="form-control">
                                                <option value="">Semua Jenis Surat</option>
                                                <option value="SKTM"
                                                    {{ request('type_surat') == 'SKTM' ? 'selected' : '' }}>SKTM</option>
                                                <option value="SKTU"
                                                    {{ request('type_surat') == 'SKTU' ? 'selected' : '' }}>SKTU</option>
                                                <option value="DOMISILI"
                                                    {{ request('type_surat') == 'DOMISILI' ? 'selected' : '' }}>Domisili
                                                </option>
                                                <option value="PINDAH"
                                                    {{ request('type_surat') == 'PINDAH' ? 'selected' : '' }}>Surat Pindah
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2">
                                            <select name="status" class="form-control">
                                                <option value="">Semua Status</option>
                                                <option value="TERVERIFIKASI"
                                                    {{ request('status') == 'TERVERIFIKASI' ? 'selected' : '' }}>
                                                    TERVERIFIKASI</option>
                                                <option value="TIDAK VALID"
                                                    {{ request('status') == 'TIDAK VALID' ? 'selected' : '' }}>TIDAK VALID
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group mr-2">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Cari nama/nomor surat..." value="{{ request('search') }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Filter
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Statistik -->
                            @php
                                $cards = [
                                    [
                                        'title' => 'Total Verifikasi',
                                        'count' => $suratVerifikasi->count(),
                                        'icon' => 'check-circle',
                                        'bg' => 'info',
                                        'route' => '#', // Ganti jika ingin diarahkan ke halaman lain
                                    ],
                                    [
                                        'title' => 'Terverifikasi',
                                        'count' => $suratVerifikasi->where('status', 'TERVERIFIKASI')->count(),
                                        'icon' => 'check-double',
                                        'bg' => 'success',
                                        'route' => '#',
                                    ],
                                    [
                                        'title' => 'Tidak Valid',
                                        'count' => $suratVerifikasi->where('status', 'TIDAK VALID')->count(),
                                        'icon' => 'times-circle',
                                        'bg' => 'danger',
                                        'route' => '#',
                                    ],
                                    [
                                        'title' => 'Hari Ini',
                                        'count' => $suratVerifikasi
                                            ->where('created_at', '>=', \Carbon\Carbon::today())
                                            ->count(),
                                        'icon' => 'fas fa-calendar',
                                        'bg' => 'warning',
                                        'route' => '#',
                                    ],
                                ];
                            @endphp

                            <div class="row mt-4">
                                @foreach ($cards as $card)
                                    <div class="col-sm-6 col-md-3">
                                        <div class="card card-stats card-{{ $card['bg'] }} card-round">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="icon-big text-center">
                                                            <i class="fas fa-{{ $card['icon'] }}"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-7 col-stats">
                                                        <div class="numbers">
                                                            <a href="{{ $card['route'] }}">
                                                                <p class="card-category">{{ $card['title'] }}</p>
                                                                <h4 class="card-title">{{ $card['count'] }}</h4>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>


                            {{-- Table data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nomor Surat</th>
                                            <th scope="col">Jenis Surat</th>
                                            <th scope="col">Nama Pemohon</th>
                                            <th scope="col">Tanggal Terbit</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Tanggal Verifikasi</th>
                                            <th scope="col">QR Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suratVerifikasi as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->nomor_surat }}</td>
                                                <td>{{ $row->type_surat }}</td>
                                                <td>{{ $row->nama_pemohon }}</td>
                                                <td>
                                                    @if ($row->tanggal_terbit instanceof \Carbon\Carbon)
                                                        {{ $row->tanggal_terbit->format('d-m-Y') }}
                                                    @else
                                                        {{ $row->tanggal_terbit }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($row->status == 'TERVERIFIKASI')
                                                        <span class="badge badge-success">{{ $row->status }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ $row->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($row->created_at instanceof \Carbon\Carbon)
                                                        {{ $row->created_at->format('d-m-Y H:i') }}
                                                    @else
                                                        {{ $row->created_at }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $qrCodePath = null;
                                                        // Determine which QR code file to use based on letter type
                                                        if ($row->type_surat == 'SKTM') {
                                                            $qrCodePath =
                                                                'storage/qrcodes/SuratKtm_' . $row->id . '.svg';
                                                        } elseif ($row->type_surat == 'SKTU') {
                                                            $qrCodePath =
                                                                'storage/qrcodes/SuratKtu_' . $row->id . '.svg';
                                                        } elseif ($row->type_surat == 'DOMISILI') {
                                                            $qrCodePath =
                                                                'storage/qrcodes/SuratDomisili_' . $row->id . '.svg';
                                                        } elseif ($row->type_surat == 'PINDAH') {
                                                            $qrCodePath =
                                                                'storage/qrcodes/SuratPindah_' . $row->id . '.svg';
                                                        }
                                                    @endphp

                                                    @if (file_exists(public_path($qrCodePath)))
                                                        <a href="{{ route('verifikasi.surat', ['token' => $row->verifikasi_token ?? $row->id]) }}"
                                                            target="_blank">
                                                            <img src="{{ asset($qrCodePath) }}" alt="QR Code"
                                                                style="width: 80px; height: 80px;">
                                                        </a>
                                                    @else
                                                        <a href="{{ route('verifikasi.surat', ['token' => $row->verifikasi_token ?? $row->id]) }}"
                                                            class="btn btn-info btn-sm" target="_blank">
                                                            <i class="fas fa-qrcode"></i> Scan QR
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                        @if (count($suratVerifikasi) == 0)
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data verifikasi</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable jika tabel memiliki data
            @if (count($suratVerifikasi) > 0)
                $('table').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                    "dom": '<"top"f>rt<"bottom"lp><"clear">',
                    "language": {
                        "search": "Cari:",
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Tidak ada data yang ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data yang tersedia",
                        "infoFiltered": "(difilter dari _MAX_ total data)",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    }
                });
            @endif
        });
    </script>
@endsection
