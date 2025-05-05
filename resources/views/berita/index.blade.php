@extends('template.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Halaman Daftar Berita</h3>
                <div class="card">
                    <div class="card-header">
                        <h5>Data Berita</h5>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahBeritaModal">
                            <i class="fas fa-plus-circle"></i> Tambah Berita
                        </button>

                        <!-- Modal Tambah Berita -->
                        <div class="modal fade" id="tambahBeritaModal" tabindex="-1" role="dialog"
                            aria-labelledby="tambahBeritaModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Data Berita</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('berita.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="judul">Judul</label>
                                                <input type="text" class="form-control" id="judul" name="judul"
                                                    value="{{ old('judul') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="konten">Konten</label>
                                                <textarea class="form-control" id="konten" name="konten" rows="3" required>{{ old('konten') }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="imageGaleri">Gambar</label>
                                                <input type="file" class="form-control-file galeri-image"
                                                        id="imageGaleri" name="image" accept="image/png, image/jpeg"
                                                        data-target="previewGaleri">
                                            </div>
                                            <img id="previewGaleri" src="" alt="Preview Foto"
                                                        class="img-thumbnail mt-2" width="100" style="display: none;">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Table data berita --}}
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Konten</th>
                                        <th scope="col">Penulis</th>
                                        <th scope="col">Tanggal Di Buat</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($berita as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($row->gambar)
                                                    <img src="{{ Storage::url($row->gambar) }}" width="100">
                                                @else
                                                    <p>Tidak ada gambar</p>
                                                @endif
                                            </td>
                                            <td>{{ $row->judul }}</td>
                                            <td>{{ Str::limit($row->konten, 50) }}</td>
                                            <td>{{ $row->user->name ?? 'Admin' }}</td>
                                            <td>{{ $row->created_at->format('d - m - Y') }}</td>

                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <button type="button" class="btn btn-warning btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#editBeritaModal{{ $row->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form action="{{ route('berita.destroy', $row->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#deleteBeritaModal{{ $row->id }}"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div class="modal fade" id="deleteBeritaModal{{ $row->id }}"
                                                tabindex="-1" aria-labelledby="deleteBeritaModalLabel{{ $row->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus
                                                            <strong>{{ $row->judul }}</strong>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <form action="{{ route('berita.destroy', $row->id) }}"
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

                                            <!-- Modal Edit Berita -->
                                            <div class="modal fade" id="editBeritaModal{{ $row->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="editBeritaModalTitle{{ $row->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data Berita</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('berita.update', $row->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="form-group">
                                                                    <label for="judul">Judul</label>
                                                                    <input type="text" class="form-control"
                                                                        id="judul{{ $row->id }}" name="judul"
                                                                        value="{{ $row->judul }}" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="konten">Konten</label>
                                                                    <textarea class="form-control" id="konten{{ $row->id }}" name="konten" rows="3" required>{{ $row->konten }}</textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="gambar">Gambar (Opsional)</label>
                                                                    <input type="file" class="form-control"
                                                                        id="gambar{{ $row->id }}" name="gambar">
                                                                
                                                                    {{-- Tambahkan ini untuk menampilkan gambar lama --}}
                                                                    @if ($row->gambar)
                                                                        <p class="mt-2">Gambar saat ini:</p>
                                                                        <img src="{{ asset('storage/' . $row->gambar) }}" width="100">
                                                                    @endif
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
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
