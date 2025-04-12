@extends('template.main')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Halaman Kelola Struktur Desa</h3>
                <div class="card">
                    <div class="card-header">
                        <h5>Struktur Desa</h5>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-plus-circle"></i> Tambah Anggota Struktur Desa
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
                                        <form action="{{ route('struktur.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    value="{{ old('nama') }}" required maxlength="255">
                                            </div>

                                            <div class="form-group">
                                                <label for="posisi">Posisi</label>
                                                <input type="text" class="form-control" id="posisi" name="posisi"
                                                    value="{{ old('posisi') }}" required maxlength="255">
                                            </div>


                                            <div class="form-group">
                                                <label for="twitter">Twitter/X</label>
                                                <input type="url" class="form-control" id="twitter" name="twitter"
                                                    value="{{ old('twitter') }}" placeholder="https://x.com/username">
                                            </div>

                                            <div class="form-group">
                                                <label for="facebook">Facebook</label>
                                                <input type="url" class="form-control" id="facebook" name="facebook"
                                                    value="{{ old('facebook') }}"
                                                    placeholder="https://facebook.com/username">
                                            </div>

                                            <div class="form-group">
                                                <label for="instagram">Instagram</label>
                                                <input type="url" class="form-control" id="instagram" name="instagram"
                                                    value="{{ old('instagram') }}"
                                                    placeholder="https://instagram.com/username">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Foto </label>
                                                <input type="file" class="form-control-file struktur-image"
                                                    id="image" name="image" accept="image/png, image/jpeg"
                                                    data-target="previewProfil">
                                                <img id="previewProfil" src="" alt="Preview Foto Profil"
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
                        {{-- End Modal --}}

                        {{-- Tabel Data  --}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Posisi</th>
                                        <th scope="col">Twitter</th>
                                        <th scope="col">Facebook</th>
                                        <th scope="col">Instagram</th>
                                        <th scope="col">Foto Profil</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($struktur as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->posisi }}</td>
                                            <td>{{ $row->twitter }}</td>
                                            <td>{{ $row->facebook }}</td>
                                            <td>{{ $row->instagram }}</td>
                                            <td><img src="{{ asset('storage/' . $row->image) }}" alt="Foto Profil"
                                                    width="100" height="100" style="border-radius: 10%"></td>
                                            <td>

                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-toggle="modal" data-target="#editModal{{ $row->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('struktur.destroy', $row->id) }}"
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
                                                            Apakah Anda yakin ingin menghapus Anggota Struktur Desa ini
                                                            ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                                Batal
                                                            </button>
                                                            <form action="{{ route('struktur.destroy', $row->id) }}"
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
                                                        <h5 class="modal-title">Edit Data Anggota Struktur</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('struktur.update', $row->id) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="nama">Nama</label>
                                                                <input type="text" class="form-control" id="nama"
                                                                    name="nama" value="{{ $row->nama }}" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="posisi">Posisi</label>
                                                                <input type="text" class="form-control" id="posisi"
                                                                    name="posisi" value="{{ $row->posisi }}" required>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="twitter">Twitter</label>
                                                                <input type="url" class="form-control" id="twitter"
                                                                    name="twitter" value="{{ $row->twitter }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="facebook">Facebook</label>
                                                                <input type="url" class="form-control" id="facebook"
                                                                    name="facebook" value="{{ $row->facebook }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="instagram">Instagram</label>
                                                                <input type="url" class="form-control" id="instagram"
                                                                    name="instagram" value="{{ $row->instagram }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="image">Foto</label>
                                                                <input type="file" class="form-control struktur-image"
                                                                    id="edit_image_{{ $row->id }}" name="image"
                                                                    accept="image/png, image/jpeg"
                                                                    data-target="edit_previewProfil_{{ $row->id }}">

                                                                <img id="edit_previewProfil_{{ $row->id }}"
                                                                    src="{{ asset('storage/' . $row->image) }}"
                                                                    alt="Preview Foto Profil" class="img-thumbnail mt-2"
                                                                    width="100">

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
@endsection
