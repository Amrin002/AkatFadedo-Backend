@extends('template.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Halaman Kelola Fasilitas Desa</h3>
                <div class="card">
                    <div class="card-header">
                        <h5>Fasilitas Desa</h5>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModalCenter"
                            @if ($fasilitas->count() > 0) disabled @endif>
                            <i class="fas fa-plus-circle"></i> Tambah Jumlah Fasilitas Desa
                        </button>
                        {{-- Modal Tambah Data --}}
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
                                        <form action="{{ route('fasilitas.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="fasilitas_pendidikan">Fasilitas Pendidikan</label>
                                                <input type="number" class="form-control" id="fasilitas_pendidikan"
                                                    name="fasilitas_pendidikan" value="{{ old('fasilitas_pendidikan') }}"
                                                    required min="0"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16)">
                                            </div>

                                            <div class="form-group">
                                                <label for="fasilitas_kesehatan">Fasilitas Kesehatan</label>
                                                <input type="number" class="form-control" id="fasilitas_kesehatan"
                                                    name="fasilitas_kesehatan" value="{{ old('fasilitas_kesehatan') }}"
                                                    required min="0"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16)">
                                            </div>

                                            <div class="form-group">
                                                <label for="luas_wilayah">Luas Wilayah (km²)</label>
                                                <input type="number" step="0.01" class="form-control" id="luas_wilayah"
                                                    name="luas_wilayah" value="{{ old('luas_wilayah') }}" required
                                                    min="0"
                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').slice(0,16)">
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary"
                                                    onclick="this.disabled=true; this.form.submit();">Simpan</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- End Modal Tambah Fasilitas --}}
                        {{-- Tabel Data --}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Jumlah Fasilitas Pendidikan</th>
                                        <th scope="col">Jumlah Fasilitas Kesehatan</th>
                                        <th scope="col">Luas Wilayah</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fasilitas as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->fasilitas_pendidikan }}</td>
                                            <td>{{ $row->fasilitas_kesehatan }}</td>
                                            <td>{{ $row->luas_wilayah }} km²</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-toggle="modal" data-target="#editModal{{ $row->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('fasilitas.destroy', $row->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#deleteModal{{ $row->id }}"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            {{-- modal Konfirmasi Hapus --}}
                                            <div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel{{ $row->id }}" aria-hidden="true">
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
                                                            Apakah Anda yakin ingin menghapus Fasilitas Desa ini
                                                            ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                                Batal
                                                            </button>
                                                            <form action="{{ route('fasilitas.destroy', $row->id) }}"
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
                                        <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1"
                                            role="dialog">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Data Fasilitas Desa</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('fasilitas.update', $row->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-group">
                                                                <label
                                                                    for="fasilitas_pendidikan_{{ $row->id }}">Fasilitas
                                                                    Pendidikan</label>
                                                                <input type="number" class="form-control"
                                                                    id="fasilitas_pendidikan_{{ $row->id }}"
                                                                    name="fasilitas_pendidikan"
                                                                    value="{{ $row->fasilitas_pendidikan }}" required
                                                                    min="0"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16)">
                                                            </div>

                                                            <div class="form-group">
                                                                <label
                                                                    for="fasilitas_kesehatan_{{ $row->id }}">Fasilitas
                                                                    Kesehatan</label>
                                                                <input type="number" class="form-control"
                                                                    id="fasilitas_kesehatan_{{ $row->id }}"
                                                                    name="fasilitas_kesehatan"
                                                                    value="{{ $row->fasilitas_kesehatan }}" required
                                                                    min="0"
                                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16)">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="luas_wilayah_{{ $row->id }}">Luas Wilayah
                                                                    (km²)
                                                                </label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="luas_wilayah_{{ $row->id }}"
                                                                    name="luas_wilayah" value="{{ $row->luas_wilayah }}"
                                                                    required min="0"
                                                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').slice(0,16)">
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">
                                                                Simpan Perubahan
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal Edit -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
