@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Domisili</h3>

                    <div class="card">
                        <div class="card-header">
                            <h5>Data Surat</h5>
                        </div>

                        <div class="card-body">
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalTambahSuratDOMISILI">
                                <i class="fas fa-plus-circle"></i> Tambah Surat
                            </button>

                            {{-- Modal Tambah Surat Domisili --}}
                            <div class="modal fade" id="modalTambahSuratDOMISILI" tabindex="-1" role="dialog"
                                aria-labelledby="modalTambahSuratDOMISILILbl" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahSuratDOMISILILbl">Tambah Surat Domisili
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('suratdomisili.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        value="{{ old('nama') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tempat_lahir"
                                                        name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="tanggal_lahir"
                                                        name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin"
                                                        required>
                                                        <option value="">Pilih Jenis Kelamin</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_kawin">Status Kawin</label>
                                                    <select class="form-control" id="status_kawin" name="status_kawin"
                                                        required>
                                                        <option value="">Pilih Status Kawin</option>
                                                        <option value="Belum kawin">Belum Kawin</option>
                                                        <option value="Sudah kawin">Sudah Kawin</option>
                                                        <option value="Cerai">Cerai</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kewarganegaraan">Kewarganegaraan</label>
                                                    <input type="text" class="form-control" id="kewarganegaraan"
                                                        name="kewarganegaraan" value="{{ old('kewarganegaraan') }}"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Tambah Surat Domisili --}}

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Surat</th>
                                            <th>Nama</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status Kawin</th>
                                            <th>Kewarganegaraan</th>
                                            <th>pekerjaan</th>
                                            <th>Alamat</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suratDomisili as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->no_surat }}</td>
                                                <td>{{ $row->nama }}</td>
                                                <td>{{ $row->tempat_lahir }}</td>
                                                <td>{{ $row->tanggal_lahir }}</td>
                                                <td>{{ $row->jenis_kelamin }}</td>
                                                <td>{{ $row->status_kawin }}</td>
                                                <td>{{ $row->kewarganegaraan }}</td>
                                                <td>{{ $row->pekerjaan }}</td>
                                                <td>{{ $row->alamat }}</td>
                                                <td>
                                                    <span
                                                        class="badge
                                                    @if ($row->status == 'On Progress') bg-warning
                                                    @elseif($row->status == 'Approve') bg-success
                                                    @elseif($row->status == 'Cancel') bg-danger
                                                    @else bg-danger @endif">
                                                        {{ $row->status }}
                                                    </span>
                                                </td>
                                                <td>{{ $row->keterangan }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $row->id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>

                                                        <form action="{{ route('suratdomisili.destroy', $row->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $row->id }}">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <form action="{{ route('suratdomisili.export.pdf', $row->id) }}"
                                                        method="GET">
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-file-pdf"></i> Export
                                                        </button>
                                                    </form>


                                                </td>
                                                {{-- modal Konfirmasi Hapus --}}
                                                <div class="modal fade" id="deleteModal{{ $row->id }}"
                                                    tabindex="-1" aria-labelledby="deleteModalLabel{{ $row->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $row->id }}">
                                                                    Konfirmasi Hapus
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus Surat ini
                                                                ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <form
                                                                    action="{{ route('suratdomisili.destroy', $row->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Ya, Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- end modal Konfirmasi Hapus --}}
                                            </tr>

                                            {{-- Modal Edit --}}
                                            <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $row->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('suratdomisili.update', $row->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Surat</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Nomor Surat</label>
                                                                    <input type="text" class="form-control"
                                                                        name="no_surat" value="{{ $row->no_surat }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Nama</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama" value="{{ $row->nama }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Tempat Lahir</label>
                                                                    <input type="text" class="form-control"
                                                                        name="tempat_lahir"
                                                                        value="{{ $row->tempat_lahir }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Tanggal Lahir</label>
                                                                    <input type="date" class="form-control"
                                                                        name="tanggal_lahir"
                                                                        value="{{ $row->tanggal_lahir }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Jenis Kelamin</label>
                                                                    <select class="form-control" name="jenis_kelamin"
                                                                        required>
                                                                        <option value="Laki-laki"
                                                                            {{ $row->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                                            Laki-laki</option>
                                                                        <option value="Perempuan"
                                                                            {{ $row->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                                            Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Status Kawin</label>
                                                                    <select class="form-control" name="status_kawin"
                                                                        required>
                                                                        <option value="Belum kawin"
                                                                            {{ $row->status_kawin == 'Belum kawin' ? 'selected' : '' }}>
                                                                            Belum Kawin</option>
                                                                        <option value="Sudah kawin"
                                                                            {{ $row->status_kawin == 'Sudah kawin' ? 'selected' : '' }}>
                                                                            Sudah Kawin</option>
                                                                        <option value="Cerai"
                                                                            {{ $row->status_kawin == 'Cerai' ? 'selected' : '' }}>
                                                                            Cerai</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Kewarganegaraan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="kewarganegaraan"
                                                                        value="{{ $row->kewarganegaraan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Pekerjaan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="pekerjaan"
                                                                        value="{{ $row->pekerjaan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Alamat</label>
                                                                    <input type="text" class="form-control"
                                                                        name="alamat" value="{{ $row->alamat }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Keterangan</label>
                                                                    <textarea class="form-control" name="keterangan">{{ $row->keterangan }}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select class="form-control" name="status" required>
                                                                        <option value="On Progress"
                                                                            {{ $row->status == 'On Progress' ? 'selected' : '' }}>
                                                                            On Progress</option>
                                                                        <option value="Approve"
                                                                            {{ $row->status == 'Approve' ? 'selected' : '' }}>
                                                                            Approve</option>
                                                                        <option value="Cancel"
                                                                            {{ $row->status == 'Cancel' ? 'selected' : '' }}>
                                                                            Cancel</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            {{-- End Modal Edit --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- End Table --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
