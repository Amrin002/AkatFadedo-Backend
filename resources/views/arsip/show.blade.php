@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>{{ $halaman }}</h3>
                        <a href="{{ route('arsip.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="row">
                        {{-- Detail Arsip --}}
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-archive"></i> Detail Arsip Surat</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Nomor Surat:</strong></td>
                                                    <td>{{ $arsip->nomor_surat }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Jenis Surat:</strong></td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $arsip->jenis_surat }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Nama Pemohon:</strong></td>
                                                    <td>{{ $arsip->nama_pemohon }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tanggal Terbit:</strong></td>
                                                    <td>{{ $arsip->tanggal_terbit->format('d F Y') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Nomor Urut:</strong></td>
                                                    <td>
                                                        <span class="badge bg-secondary">{{ $arsip->nomor_urut }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status:</strong></td>
                                                    <td>
                                                        <span
                                                            class="badge 
                                                            @if ($arsip->status == 'Terarsip') bg-success
                                                            @else bg-warning @endif">
                                                            {{ $arsip->status }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Diarsipkan:</strong></td>
                                                    <td>{{ $arsip->created_at->format('d F Y H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Terakhir Update:</strong></td>
                                                    <td>{{ $arsip->updated_at->format('d F Y H:i') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    @if ($arsip->keterangan)
                                        <div class="mt-3">
                                            <strong>Keterangan:</strong>
                                            <div class="alert alert-light mt-2">
                                                {{ $arsip->keterangan }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Action Panel --}}
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-cogs"></i> Aksi</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        {{-- Edit Arsip --}}
                                        <a href="{{ route('arsip.edit', $arsip->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit Arsip
                                        </a>

                                        {{-- Lihat Surat Asli --}}
                                        @if ($arsip->surat)
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#detailSuratModal">
                                                <i class="fas fa-file-alt"></i> Lihat Surat Asli
                                            </button>
                                        @endif

                                        {{-- Export/Download --}}
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-download"></i> Export
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('arsip.export.csv', ['nomor_surat' => $arsip->nomor_surat]) }}">
                                                    <i class="fas fa-file-csv"></i> Export CSV
                                                </a>
                                                @if ($arsip->surat && $arsip->surat->status == 'Approve')
                                                    <a class="dropdown-item" href="#" onclick="window.print()">
                                                        <i class="fas fa-print"></i> Print Detail
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Hapus Arsip --}}
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteModal">
                                            <i class="fas fa-trash"></i> Hapus Arsip
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- Info Tambahan --}}
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5><i class="fas fa-info-circle"></i> Informasi</h5>
                                </div>
                                <div class="card-body">
                                    <small class="text-muted">
                                        <div class="mb-2">
                                            <strong>Kode Jenis:</strong> {{ $arsip->getKodeJenisSurat() }}
                                        </div>
                                        <div class="mb-2">
                                            <strong>Tahun Surat:</strong> {{ $arsip->getTahunFromNomor() }}
                                        </div>
                                        <div class="mb-2">
                                            <strong>ID Surat:</strong> {{ $arsip->surat_id }}
                                        </div>
                                        <div>
                                            <strong>Tipe Model:</strong> {{ class_basename($arsip->surat_type) }}
                                        </div>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Detail Surat Asli --}}
                    @if ($arsip->surat)
                        <div class="modal fade" id="detailSuratModal" tabindex="-1" aria-labelledby="detailSuratModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailSuratModalLabel">Detail Surat Asli</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <table class="table table-borderless table-sm">
                                                    <tr>
                                                        <td><strong>Nama:</strong></td>
                                                        <td>{{ $arsip->surat->nama }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tempat Lahir:</strong></td>
                                                        <td>{{ $arsip->surat->tempat_lahir }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tanggal Lahir:</strong></td>
                                                        <td>{{ $arsip->surat->tanggal_lahir }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Jenis Kelamin:</strong></td>
                                                        <td>{{ $arsip->surat->jenis_kelamin }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table table-borderless table-sm">
                                                    @if (isset($arsip->surat->status_kawin))
                                                        <tr>
                                                            <td><strong>Status Kawin:</strong></td>
                                                            <td>{{ $arsip->surat->status_kawin }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td><strong>Kewarganegaraan:</strong></td>
                                                        <td>{{ $arsip->surat->kewarganegaraan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Alamat:</strong></td>
                                                        <td>{{ $arsip->surat->alamat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Status Surat:</strong></td>
                                                        <td>
                                                            <span
                                                                class="badge 
                                                                @if ($arsip->surat->status == 'Approve') bg-success
                                                                @elseif($arsip->surat->status == 'On Progress') bg-warning
                                                                @else bg-danger @endif">
                                                                {{ $arsip->surat->status }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        @if ($arsip->surat->keterangan)
                                            <div class="mt-3">
                                                <strong>Keterangan Surat:</strong>
                                                <div class="alert alert-light mt-2">
                                                    {{ $arsip->surat->keterangan }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Modal Konfirmasi Hapus --}}
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Arsip</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                                    </div>
                                    <p>Apakah Anda yakin ingin menghapus arsip surat ini?</p>
                                    <div class="alert alert-warning">
                                        <strong>Nomor Surat:</strong> {{ $arsip->nomor_surat }}<br>
                                        <strong>Nama Pemohon:</strong> {{ $arsip->nama_pemohon }}<br>
                                        <strong>Jenis Surat:</strong> {{ $arsip->jenis_surat }}
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <form action="{{ route('arsip.destroy', $arsip->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Ya, Hapus Arsip
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
