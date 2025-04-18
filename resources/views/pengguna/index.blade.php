@extends('template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Daftar Pengguna</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fas fa-plus-circle"></i> Tambah Pengguna
                            </button>
                            <!-- Modal -->
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
                                            <form action="{{ route('pengguna.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nik">NIK</label>
                                                    <input type="text" class="form-control" id="nik" name="nik"
                                                        value="{{ old('nik') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ old('name') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_telp">Nomor Telepon</label>
                                                    <input type="text" class="form-control" id="no_telp" name="no_telp"
                                                        value="{{ old('no_telp') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ old('email') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select class="form-control" id="role" name="role" required>
                                                        <option value="">Pilih Role</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Foto Profil</label>
                                                    <input type="file" class="form-control-file" id="image"
                                                        name="image" accept="image/*" onchange="previewImage(event)">
                                                    <img id="photoPreview" src="#" alt="Preview Foto"
                                                        class="img-thumbnail mt-2" style="max-width: 150px; display: none;">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                            <!-- Modal Error NIK -->
                                            <div class="modal fade" id="nikErrorModal" tabindex="-1"
                                                aria-labelledby="nikErrorModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content border-danger">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title" id="nikErrorModalLabel">
                                                                NIK Tidak Ditemukan</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            NIK yang Anda masukkan tidak terdaftar dalam data
                                                            penduduk. Silakan cek kembali.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- endmodal error --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Table data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIK</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Nomor Telepon</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Foto Profil</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->nik }}</td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->no_telp }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>{{ $row->role }}</td>
                                                <td><img src="{{ asset('storage/' . $row->image) }}" alt="Foto Profil"
                                                        width="50" height="50" style="border-radius: 50%;"></td>
                                                <td>
                                                    {{-- <div class="row">
                                                        <button type="button" class="btn btn-warning btn-sm mb-3"
                                                            data-toggle="modal" data-target="#editModal{{ $row->id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <form action="{{ route('pengguna.destroy', $row->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                onclick="return confirm('Apakah Anda Yakin?')"
                                                                class="btn btn-danger btn-sm ms-2 ml-2">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </div> --}}
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $row->id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <form action="{{ route('pengguna.destroy', $row->id) }}"
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
                                                <!-- Modal Konfirmasi Hapus -->
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
                                                                Apakah Anda yakin ingin menghapus
                                                                <strong>{{ $row->name }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <form action="{{ route('pengguna.destroy', $row->id) }}"
                                                                    enctype="multipart/form-data" method="POST">
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
                                                role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Data Pengguna</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('pengguna.update', $row->id) }}"
                                                                enctype="multipart/form-data" method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <!-- Input NIK -->
                                                                <div class="form-group">
                                                                    <label for="nik">NIK</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nik{{ $row->id }}" name="nik"
                                                                        value="{{ $row->nik }}" required>
                                                                </div>

                                                                <!-- Input Name -->
                                                                <div class="form-group">
                                                                    <label for="name">Nama</label>
                                                                    <input type="text" class="form-control"
                                                                        id="name{{ $row->id }}" name="name"
                                                                        value="{{ $row->name }}" required>
                                                                </div>

                                                                <!-- Input No Telp -->
                                                                <div class="form-group">
                                                                    <label for="no_telp">Nomor Telepon</label>
                                                                    <input type="text" class="form-control"
                                                                        id="no_telp{{ $row->id }}" name="no_telp"
                                                                        value="{{ $row->no_telp }}" required>
                                                                </div>

                                                                <!-- Input Email -->
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        id="email{{ $row->id }}" name="email"
                                                                        value="{{ $row->email }}" required>
                                                                </div>

                                                                <!-- Input Password (Opsional) -->
                                                                <div class="form-group">
                                                                    <label for="password">Password (Kosongkan jika tidak
                                                                        diubah)</label>
                                                                    <input type="password" class="form-control"
                                                                        id="password{{ $row->id }}" name="password"
                                                                        placeholder="Masukkan password baru">
                                                                </div>

                                                                <!-- Select Role -->
                                                                <div class="form-group">
                                                                    <label for="role">Role</label>
                                                                    <select class="form-control"
                                                                        id="role{{ $row->id }}" name="role"
                                                                        required>
                                                                        <option value="admin"
                                                                            {{ $row->role == 'admin' ? 'selected' : '' }}>
                                                                            Admin
                                                                        </option>
                                                                        <option value="user"
                                                                            {{ $row->role == 'user' ? 'selected' : '' }}>
                                                                            User
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="image{{ $row->id }}">Foto
                                                                        Profil</label>
                                                                    <input type="file" class="form-control-file"
                                                                        id="image{{ $row->id }}" name="image"
                                                                        accept="image/*"
                                                                        onchange="previewImage(event, {{ $row->id }})">
                                                                    <img id="photoPreview{{ $row->id }}"
                                                                        src="{{ $row->image ? asset('storage/' . $row->image) : '#' }}"
                                                                        alt="Preview Foto" class="img-thumbnail mt-2"
                                                                        style="max-width: 150px; display: {{ $row->image ? 'block' : 'none' }};">
                                                                </div>
                                                                <!-- Tombol Simpan & Batal -->
                                                                <div class="form-group">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Modal Edit -->


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
