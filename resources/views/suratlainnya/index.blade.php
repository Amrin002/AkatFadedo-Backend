@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Surat Lainnya</h3>

                    <div class="card">
                        <div class="card-header">
                            <h5>Data Surat</h5>
                        </div>

                        <div class="card-body">
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalTambahSuratLAINNYA">
                                <i class="fas fa-plus-circle"></i>Tambah Surat
                            </button>

                            {{-- Modal Tambah Surat Lainnya --}}
                            <div class="modal fade" id="modalTambahSuratLAINNYA" tabindex="-1" role="dialog"
                                aria-labelledby="modalTambahSuratLAINNYAbl" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahSuratLAINNYALbl">Tambah Surat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('suratlainnya.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        value="{{ old('nama') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="file">File "PDF/DOCX", Size Max = 2Mb</label>
                                                    <input type="file" class="form-control" id="file" name="file"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Tambah Surat Lainnya --}}

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>File</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suratLainnya as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->nama }}</td>
                                                <td>{{ $row->keterangan }}</td>
                                                <td>{{ basename($row->file) }}</td>
                                                <td>
                                                    <span
                                                        class="badge
                                                        @if ($row->status == 'On Progress') bg-warning
                                                        @elseif($row->status == 'Approve') bg-success
                                                        @elseif($row->status == 'Cancel') bg-secondary
                                                        @else bg-danger @endif">
                                                        {{ $row->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal" data-target="#editModal{{ $row->id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>

                                                        <form action="{{ route('suratlainnya.destroy', $row->id) }}"
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


                                                </td>
                                                {{-- modal Konfirmasi Hapus --}}
                                                <div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1"
                                                    aria-labelledby="deleteModalLabel{{ $row->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $row->id }}">
                                                                    Konfirmasi Hapus
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
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
                                                                    action="{{ route('suratlainnya.destroy', $row->id) }}"
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
                                                    <form action="{{ route('suratlainnya.update', $row->id) }}"
                                                        method="POST" enctype="multipart/form-data">
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
                                                                    <label>Nama</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nama" value="{{ $row->nama }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Keterangan</label>
                                                                    <textarea class="form-control" name="keterangan">{{ $row->keterangan }}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>File "PDF/DOCX", Size Max = 2Mb</label>
                                                                    <input type="file" class="form-control"
                                                                        name="file">
                                                                    <small>File saat ini: <a
                                                                            href="{{ asset('storage/' . $row->file) }}"
                                                                            target="_blank">{{ $row->file }}</a></small>
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
