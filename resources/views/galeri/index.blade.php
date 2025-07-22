@extends('template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Galeri Desa</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5>Galeri Desa</h5>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fas fa-plus-circle"></i> Tambah Galeri
                            </button>
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Galeri</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('galeri.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama_kegiatan"></label>
                                                    <input type="text" class="form-control" id="nama_kegiatan"
                                                        name="nama_kegiatan" value="{{ old('nama_kegiatan') }} " required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="imageGaleri">Foto Kegiatan</label>
                                                    <input type="file" class="form-control-file galeri-image"
                                                        id="imageGaleri" name="image" accept="gambar/png, gambar/jpeg"
                                                        data-target="previewGaleri">
                                                    <!-- Preview Image -->
                                                    <img id="previewGaleri" src="" alt="Preview Foto"
                                                        class="img-thumbnail mt-2" width="100" style="display: none;">
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Tambah Data --}}
                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Kegiatan</th>
                                            <th scope="col">Foto Kegiatan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galeri as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->nama_kegiatan }}</td>
                                                <td><img src="{{ asset('storage/' . $row->image) }}" alt="Foto Profil"
                                                        width="100" height="100" style="border-radius: 10%"></td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal" data-target="#editModal{{ $row->id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <form action="{{ route('galeri.destroy', $row->id) }}"
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
                                                                Apakah Anda yakin ingin menghapus Kegiatan Desa ini
                                                                ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <form action="{{ route('galeri.destroy', $row->id) }}"
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
                                                            <h5 class="modal-title">Edit Kegiatan Desa</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('galeri.update', $row->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="nama">Nama Kegiatan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama" name="nama_kegiatan"
                                                                        value="{{ $row->nama_kegiatan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="image">Foto Kegiatan</label>
                                                                    <input type="file"
                                                                        class="form-control galeri-image" id="image"
                                                                        name="image">
                                                                    @if ($row->image)
                                                                        <img src="{{ asset('storage/' . $row->image) }}"
                                                                            alt="Foto" class="img-thumbnail mt-2"
                                                                            width="100">
                                                                    @endif
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">
                                                                    Simpan Perubahan
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
