@extends('template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Data Penduduk</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Penduduk</h5>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fas fa-plus-circle"></i> Tambah Penduduk
                            </button>
                            <form action="{{ route('penduduk.export') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success mb-3">
                                    <i class="fas fa-file-excel"></i> Export ke Excel
                                </button>
                            </form>
                            {{-- Modal Tambah Penduduk --}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Penduduk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('penduduk.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="no_kk">Nomor KK</label>
                                                    <input type="text" name="no_kk"
                                                        class="form-control {{ $errors->first('no_kk') ? 'is-invalid' : '' }}"
                                                        id="no_kk" placeholder="No KK" value="{{ old('no_kk') }}"
                                                        required maxlength="16">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('no_kk') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nik">Nomor NIK</label>
                                                    <input type="text" name="nik"
                                                        class="form-control {{ $errors->first('nik') ? 'is-invalid' : '' }}"
                                                        id="nik" placeholder="No NIK" value="{{ old('nik') }}"
                                                        required maxlength="16">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('nik') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_lengkap">Nama Lengkap</label>
                                                    <input type="text" name="nama_lengkap"
                                                        class="form-control {{ $errors->first('nama_lengkap') ? 'is-invalid' : '' }} "
                                                        id="nama_lengkap" placeholder="Nama Lengkap"
                                                        value="{{ old('nama_lengkap') }}" required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('nama_lengkap') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                    <input type="text" name="tempat_lahir"
                                                        class="form-control {{ $errors->first('tempat_lahir') ? 'is-invalid' : '' }} "
                                                        id="tempat_lahir" placeholder="Tempat Lahir"
                                                        value="{{ old('tempat_lahir') }}" required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('tempat_lahir') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tanggal Lahir</label>
                                                    <div class="input-group date" id="datepicker">
                                                        <div class="input-group-append">
                                                        </div>
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                        <input name="tanggal_lahir" type="date"
                                                            class="form-control {{ $errors->first('tanggal_lahir') ? 'is-invalid' : '' }}"
                                                            value="{{ old('tanggal_lahir') }}" autocomplete="off" required>

                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('tanggal_lahir') }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="level">Jenis Kelamin</label>
                                                    <div class="form-check form-check-inline">
                                                        <label class="form-check-label inline-block">Laki-Laki</label>
                                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                            value="laki"
                                                            {{ old('jenis_kelamin') == 'laki' ? 'checked' : '' }} required>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <label
                                                            class="form-check-label {{ $errors->first('jenis_kelamin') ? 'is-invalid' : '' }}">Perempuan</label>
                                                        <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                            value="perempuan"
                                                            {{ old('jenis_kelamin') == 'perempuan' ? 'checked' : '' }}
                                                            required>
                                                        <div class="invalid-feedback">
                                                            &emsp;{{ $errors->first('jenis_kelamin') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <select
                                                        class="form-control {{ $errors->first('agama') ? 'is-invalid' : '' }}"
                                                        name="agama" required>
                                                        <option value="Islam"
                                                            {{ old('agama') == 'Islam' ? ' selected' : '' }}>Islam</option>
                                                        <option value="Protestan"
                                                            {{ old('agama') == 'Protestan' ? ' selected' : '' }}>Protestan
                                                        </option>
                                                        <option value="Hindu"
                                                            {{ old('agama') == 'Hindu' ? ' selected' : '' }}>Hindu</option>
                                                        <option value="Katolik"
                                                            {{ old('agama') == 'Katolik' ? ' selected' : '' }}>Katolik
                                                        </option>
                                                        <option value="Buddha"
                                                            {{ old('agama') == 'Buddha' ? ' selected' : '' }}>Buddha
                                                        </option>
                                                        <option value="Khonghucu"
                                                            {{ old('agama') == 'Khonghucu' ? ' selected' : '' }}>Khonghucu
                                                        </option>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('agama') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pendidikan">Pendidikan</label>
                                                    <input type="text" name="pendidikan"
                                                        class="form-control {{ $errors->first('pendidikan') ? 'is-invalid' : '' }}"
                                                        id="pendidikan" placeholder="Pendidikan"
                                                        value="{{ old('pendidikan') }}" required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('pendidikan') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pekerjaan">Pekerjaan</label>
                                                    <input type="text" name="pekerjaan"
                                                        class="form-control {{ $errors->first('pekerjaan') ? 'is-invalid' : '' }}"
                                                        id="pekerjaan" placeholder="Pekerjaan"
                                                        value="{{ old('pekerjaan') }}" required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('pekerjaan') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <input type="text" name="status"
                                                        class="form-control {{ $errors->first('status') ? 'is-invalid' : '' }}"
                                                        id="status" placeholder="Status" value="{{ old('status') }}"
                                                        required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('status') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_keluarga">Status Keluarga</label>
                                                    <input type="text" name="status_keluarga"
                                                        class="form-control {{ $errors->first('status_keluarga') ? 'is-invalid' : '' }}"
                                                        required id="status_keluarga" placeholder="Status Keluarga"
                                                        value="{{ old('status_keluarga') }}">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('status_keluarga') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="golongan_darah">Golongan Darah</label>
                                                    <input type="text" name="golongan_darah"
                                                        class="form-control {{ $errors->first('golongan_darah') ? 'is-invalid' : '' }}"
                                                        required id="golongan_darah" placeholder="Golongan Darah"
                                                        value="{{ old('golongan_darah') }}">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('golongan_darah') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kewarganegaraan">Kewarganegaraan</label>
                                                    <input type="text" name="kewarganegaraan"
                                                        class="form-control {{ $errors->first('kewarganegaraan') ? 'is-invalid' : '' }}"
                                                        required id="kewarganegaraan" placeholder="Kewarganegaraan"
                                                        value="{{ old('kewarganegaraan') }}">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('kewarganegaraan') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_ayah">Nama Ayah</label>
                                                    <input type="text" name="nama_ayah"
                                                        class="form-control {{ $errors->first('nama_ayah') ? 'is-invalid' : '' }}"
                                                        required id="nama_ayah" placeholder="Nama Ayah"
                                                        value="{{ old('nama_ayah') }}">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('nama_ayah') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_ibu">Nama Ibu</label>
                                                    <input type="text" name="nama_ibu"
                                                        class="form-control {{ $errors->first('nama_ibu') ? 'is-invalid' : '' }}"
                                                        id="nama_ibu" placeholder="Nama Ibu"
                                                        value="{{ old('nama_ibu') }}" required>
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('nama_ibu') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email"
                                                        class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                                                        id="email" placeholder="Email" value="{{ old('email') }}">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('email') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_hp">No Hp</label>
                                                    <input type="text" name="no_hp"
                                                        class="form-control  {{ $errors->first('no_hp') ? 'is-invalid' : '' }}"
                                                        id="no_hp" placeholder="No Hp" value="{{ old('no_hp') }}">
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('no_hp') }}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                            <form action="{{ route('penduduk.import') }}" method="POST"
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
                                                        <i class="fas fa-file-upload"></i> Import Penduduk
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Tambah KK --}}
                            <!-- Modal Alert Error -->
                            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="errorModalLabel">Error!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($errors->any())
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">No KK</th>
                                            <th scope="col">NIK</th>
                                            <th scope="col">Nama Lengkap</th>
                                            <th scope="col">Tempat Lahir</th>
                                            <th scope="col">Tanggal Lahir</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Agama</th>
                                            <th scope="col">Pendidikan</th>
                                            <th scope="col">Pekerjaan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Status Keluarga</th>
                                            <th scope="col">Golongan Darah</th>
                                            <th scope="col">Kewarganegaraan</th>
                                            <th scope="col">Nama Ayah</th>
                                            <th scope="col">Nama Ibu</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">No HP</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($penduduk as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->no_kk }}</td>
                                                <td>{{ $row->nik }}</td>
                                                <td>{{ $row->nama_lengkap }}</td>
                                                <td>{{ $row->tempat_lahir }}</td>
                                                <td>{{ $row->tanggal_lahir }}</td>
                                                <td>{{ $row->jenis_kelamin }}</td>
                                                <td>{{ $row->agama }}</td>
                                                <td>{{ $row->pendidikan }}</td>
                                                <td>{{ $row->pekerjaan }}</td>
                                                <td>{{ $row->status }}</td>
                                                <td>{{ $row->status_keluarga }}</td>
                                                <td>{{ $row->golongan_darah }}</td>
                                                <td>{{ $row->kewarganegaraan }}</td>
                                                <td>{{ $row->nama_ayah }}</td>
                                                <td>{{ $row->nama_ibu }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>{{ $row->no_hp }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $row->id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <form action="{{ route('penduduk.destroy', $row->id) }}"
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
                                                {{-- modal Hapus --}}
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
                                                                Apakah Anda yakin ingin menghapus nama
                                                                <strong>{{ $row->nama_lengkap }}</strong>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <form action="{{ route('penduduk.destroy', $row->id) }}"
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
                                            </tr>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $row->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editModalLabel{{ $row->id }}">
                                                                Edit Data Penduduk</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('penduduk.update', $row->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="nama_lengkap">Nama Lengkap</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama_lengkap" name="nama_lengkap"
                                                                        value="{{ $row->nama_lengkap }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                                    <input type="text" class="form-control"
                                                                        id="tempat_lahir" name="tempat_lahir"
                                                                        value="{{ $row->tempat_lahir }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                                    <input type="date" class="form-control"
                                                                        id="tanggal_lahir" name="tanggal_lahir"
                                                                        value="{{ $row->tanggal_lahir }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                                                    <select class="form-control" id="jenis_kelamin"
                                                                        name="jenis_kelamin" required>
                                                                        <option value="laki"
                                                                            {{ $row->jenis_kelamin == 'laki' ? 'selected' : '' }}>
                                                                            Laki-laki</option>
                                                                        <option value="perempuan"
                                                                            {{ $row->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                                                            Perempuan</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="agama">Agama</label>
                                                                    <input type="text" class="form-control"
                                                                        id="agama" name="agama"
                                                                        value="{{ $row->agama }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="pendidikan">Pendidikan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="pendidikan" name="pendidikan"
                                                                        value="{{ $row->pendidikan }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="pekerjaan">Pekerjaan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="pekerjaan" name="pekerjaan"
                                                                        value="{{ $row->pekerjaan }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <input type="text" class="form-control"
                                                                        id="status" name="status"
                                                                        value="{{ $row->status }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status_keluarga">Status Keluarga</label>
                                                                    <input type="text" class="form-control"
                                                                        id="status_keluarga" name="status_keluarga"
                                                                        value="{{ $row->status_keluarga }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="golongan_darah">Golongan Darah</label>
                                                                    <input type="text" class="form-control"
                                                                        id="golongan_darah" name="golongan_darah"
                                                                        value="{{ $row->golongan_darah }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kewarganegaraan">Kewarganegaraan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="kewarganegaraan" name="kewarganegaraan"
                                                                        value="{{ $row->kewarganegaraan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama_ayah">Nama Ayah</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama_ayah" name="nama_ayah"
                                                                        value="{{ $row->nama_ayah }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama_ibu">Nama Ibu</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama_ibu" name="nama_ibu"
                                                                        value="{{ $row->nama_ibu }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="email" class="form-control"
                                                                        id="email" name="email"
                                                                        value="{{ $row->email }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="no_hp">No HP</label>
                                                                    <input type="text" class="form-control"
                                                                        id="no_hp" name="no_hp"
                                                                        value="{{ $row->no_hp }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                        </form>
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
