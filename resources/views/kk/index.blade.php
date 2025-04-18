@extends('template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Data KK</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5>Data KK</h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fas fa-plus-circle"></i> Tambah KK
                            </button>
                            <form action="{{ route('kk.export') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success mb-3">
                                    <i class="fas fa-file-excel"></i> Export ke Excel
                                </button>
                            </form>


                            {{-- Modal Tambah KK --}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Pengguna</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('kk.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="no_kk">Nomor KK</label>
                                                    <input type="number" class="form-control" id="no_kk" name="no_kk"
                                                        value="{{ old('no_kk') }} " required maxlength="16"
                                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16)">
                                                </div>

                                                <div class="form-group">
                                                    <label for="dusun">Dusun</label>
                                                    <input type="text" class="form-control" id="dusun" name="dusun"
                                                        value="{{ old('dusun') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rt">RT</label>
                                                    <input type="number" class="form-control" id="rt" name="rt"
                                                        value="{{ old('rt') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="rw">RW</label>
                                                    <input type="number" class="form-control" id="rw" name="rw"
                                                        value="{{ old('rw') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="desa">Desa</label>
                                                    <input type="text" class="form-control" id="desa" name="desa"
                                                        value="{{ old('desa') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kecamatan">Kecamatan</label>
                                                    <input type="text" class="form-control" id="kecamatan"
                                                        name="kecamatan" value="{{ old('kecamatan') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kabupaten">Kabupaten</label>
                                                    <input type="text" class="form-control" id="kabupaten"
                                                        name="kabupaten" value="{{ old('kabupaten') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="provinsi">Provinsi</label>
                                                    <input type="text" class="form-control" id="provinsi"
                                                        name="provinsi" value="{{ old('provinsi') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                            <form action="{{ route('kk.importkk') }}" method="POST"
                                                enctype="multipart/form-data" style="display: inline;">
                                                @csrf

                                                <div class="form-group">
                                                    <input type="file" name="file" required
                                                        accept=".xlsx, .xls, .csv"
                                                        style="display: inline-block; width: auto;"
                                                        class="form-control-file mb-2">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary mb-3">
                                                        <i class="fas fa-file-upload"></i> Import KK
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- End Modal Tambah KK --}}
                            {{-- Tabel Data --}}

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nomor KK</th>
                                            <th scope="col">Dusun</th>
                                            <th scope="col">RT</th>
                                            <th scope="col">RW</th>
                                            <th scope="col">Desa</th>
                                            <th scope="col">Kecamatan</th>
                                            <th scope="col">Kabupaten</th>
                                            <th scope="col">Provinsi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kk as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->no_kk }}</td>
                                                <td>{{ $row->dusun }}</td>
                                                <td>{{ $row->rt }}</td>
                                                <td>{{ $row->rw }}</td>
                                                <td>{{ $row->desa }}</td>
                                                <td>{{ $row->kecamatan }}</td>
                                                <td>{{ $row->kabupaten }}</td>
                                                <td>{{ $row->provinsi }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $row->no_kk }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <form action="{{ route('kk.destroy', $row->no_kk) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#deleteModal{{ $row->no_kk }}"
                                                                class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                {{-- modal Konfirmasi Hapus --}}
                                                <div class="modal fade" id="deleteModal{{ $row->no_kk }}"
                                                    tabindex="-1" aria-labelledby="deleteModalLabel{{ $row->no_kk }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="deleteModalLabel{{ $row->no_kk }}">
                                                                    Konfirmasi Hapus
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus No KK
                                                                <strong>{{ $row->no_kk }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <form action="{{ route('kk.destroy', $row->no_kk) }}"
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
                                            {{-- Modal edit --}}
                                            <div class="modal fade" id="editModal{{ $row->no_kk }}" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data KK</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('kk.update', $row->no_kk) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="form-group">
                                                                    <label for="dusun">Dusun</label>
                                                                    <input type="text" class="form-control"
                                                                        name="dusun" value="{{ $row->dusun }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="rt">RT</label>
                                                                    <input type="text" class="form-control"
                                                                        name="rt" value="{{ $row->rt }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="rw">RW</label>
                                                                    <input type="text" class="form-control"
                                                                        name="rw" value="{{ $row->rw }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="desa">Desa</label>
                                                                    <input type="text" class="form-control"
                                                                        name="desa" value="{{ $row->desa }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="kecamatan">Kecamatan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="kecamatan" value="{{ $row->kecamatan }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="kabupaten">Kabupaten</label>
                                                                    <input type="text" class="form-control"
                                                                        name="kabupaten" value="{{ $row->kabupaten }}"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="provinsi">Provinsi</label>
                                                                    <input type="text" class="form-control"
                                                                        name="provinsi" value="{{ $row->provinsi }}"
                                                                        required>
                                                                </div>

                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
