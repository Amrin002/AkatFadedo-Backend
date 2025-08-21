@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>{{ $halaman }}</h3>

                    {{-- Card Statistik --}}
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-archive text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Total Arsip</p>
                                                <h4 class="card-title">{{ $statistik['total_arsip'] }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-calendar text-success"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Tahun Ini</p>
                                                <h4 class="card-title">{{ $statistik['arsip_tahun_ini'] }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-calendar-day text-info"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Bulan Ini</p>
                                                <h4 class="card-title">{{ $statistik['arsip_bulan_ini'] }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="icon-big text-center">
                                                <i class="fas fa-file-export text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="col-7 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Export</p>
                                                <a href="{{ route('arsip.export.csv', request()->query()) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-download"></i> CSV
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>Data Arsip Surat</h5>
                        </div>

                        <div class="card-body">
                            {{-- Form Filter --}}
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <form method="GET" action="{{ route('arsip.index') }}" class="row g-3">
                                        <div class="col-md-3">
                                            <label class="form-label">Jenis Surat</label>
                                            <select name="jenis_surat" class="form-control">
                                                <option value="">Semua Jenis</option>
                                                @foreach ($jenisSurats as $jenis)
                                                    <option value="{{ $jenis }}"
                                                        {{ request('jenis_surat') == $jenis ? 'selected' : '' }}>
                                                        {{ $jenis }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Tahun</label>
                                            <select name="tahun" class="form-control">
                                                <option value="">Semua Tahun</option>
                                                @foreach ($tahunList as $tahun)
                                                    <option value="{{ $tahun }}"
                                                        {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                                        {{ $tahun }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Bulan</label>
                                            <select name="bulan" class="form-control">
                                                <option value="">Semua Bulan</option>
                                                <option value="1" {{ request('bulan') == '1' ? 'selected' : '' }}>
                                                    Januari</option>
                                                <option value="2" {{ request('bulan') == '2' ? 'selected' : '' }}>
                                                    Februari</option>
                                                <option value="3" {{ request('bulan') == '3' ? 'selected' : '' }}>
                                                    Maret</option>
                                                <option value="4" {{ request('bulan') == '4' ? 'selected' : '' }}>
                                                    April</option>
                                                <option value="5" {{ request('bulan') == '5' ? 'selected' : '' }}>Mei
                                                </option>
                                                <option value="6" {{ request('bulan') == '6' ? 'selected' : '' }}>Juni
                                                </option>
                                                <option value="7" {{ request('bulan') == '7' ? 'selected' : '' }}>Juli
                                                </option>
                                                <option value="8" {{ request('bulan') == '8' ? 'selected' : '' }}>
                                                    Agustus</option>
                                                <option value="9" {{ request('bulan') == '9' ? 'selected' : '' }}>
                                                    September</option>
                                                <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>
                                                    Oktober</option>
                                                <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>
                                                    November</option>
                                                <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>
                                                    Desember</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Cari</label>
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Nomor surat atau nama pemohon..."
                                                value="{{ request('search') }}">
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">&nbsp;</label>
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-search"></i> Filter
                                                </button>
                                                <a href="{{ route('arsip.index') }}" class="btn btn-secondary btn-sm">
                                                    <i class="fas fa-times"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor Surat</th>
                                            <th>Jenis Surat</th>
                                            <th>Nama Pemohon</th>
                                            <th>Tanggal Terbit</th>
                                            <th>No Urut</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($arsipSurats as $arsip)
                                            <tr>
                                                <td>{{ $loop->iteration + ($arsipSurats->currentPage() - 1) * $arsipSurats->perPage() }}
                                                </td>
                                                <td>
                                                    <strong>{{ $arsip->nomor_surat }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $arsip->jenis_surat }}</span>
                                                </td>
                                                <td>{{ $arsip->nama_pemohon }}</td>
                                                <td>{{ $arsip->tanggal_terbit->format('d/m/Y') }}</td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $arsip->nomor_urut }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge 
                                                        @if ($arsip->status == 'Terarsip') bg-success
                                                        @else bg-warning @endif">
                                                        {{ $arsip->status }}
                                                    </span>
                                                </td>
                                                <td>{{ Str::limit($arsip->keterangan, 50) }}</td>
                                                <td>
                                                    <div class="d-flex flex-column align-items-start">
                                                        <div class="d-flex align-items-center gap-2">
                                                            {{-- Tombol Detail --}}
                                                            <a href="{{ route('arsip.show', $arsip->id) }}"
                                                                class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye"></i> Detail
                                                            </a>

                                                            {{-- Tombol Edit --}}
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $arsip->id }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </button>

                                                            {{-- Tombol Hapus --}}
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $arsip->id }}">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- Modal Edit --}}
                                                <div class="modal fade" id="editModal{{ $arsip->id }}" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{ $arsip->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('arsip.update', $arsip->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Arsip Surat</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label>Nomor Surat</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $arsip->nomor_surat }}" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nama Pemohon</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $arsip->nama_pemohon }}" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Status</label>
                                                                        <select class="form-control" name="status"
                                                                            required>
                                                                            <option value="Terarsip"
                                                                                {{ $arsip->status == 'Terarsip' ? 'selected' : '' }}>
                                                                                Terarsip
                                                                            </option>
                                                                            <option value="Aktif"
                                                                                {{ $arsip->status == 'Aktif' ? 'selected' : '' }}>
                                                                                Aktif
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Keterangan</label>
                                                                        <textarea class="form-control" name="keterangan" rows="3">{{ $arsip->keterangan }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan
                                                                        Perubahan</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                {{-- Modal Konfirmasi Hapus --}}
                                                <div class="modal fade" id="deleteModal{{ $arsip->id }}"
                                                    tabindex="-1" aria-labelledby="deleteModalLabel{{ $arsip->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $arsip->id }}">
                                                                    Konfirmasi Hapus Arsip
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus arsip surat ini?</p>
                                                                <div class="alert alert-warning">
                                                                    <strong>Nomor Surat:</strong>
                                                                    {{ $arsip->nomor_surat }}<br>
                                                                    <strong>Nama Pemohon:</strong>
                                                                    {{ $arsip->nama_pemohon }}
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <form action="{{ route('arsip.destroy', $arsip->id) }}"
                                                                    method="POST" style="display: inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Ya,
                                                                        Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle"></i> Tidak ada data arsip yang
                                                        ditemukan.
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if ($arsipSurats->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $arsipSurats->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
