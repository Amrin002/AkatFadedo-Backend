@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Surat Keterangan Penghasilan Tetap</h3>

                    <div class="card">
                        <div class="card-header">
                            <h5>Data Surat KPT</h5>
                        </div>

                        <div class="card-body">
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalTambahSuratKPT">
                                <i class="fas fa-plus-circle"></i> Tambah Surat
                            </button>

                            {{-- Modal Tambah Surat KPT --}}
                            <div class="modal fade" id="modalTambahSuratKPT" tabindex="-1" role="dialog"
                                aria-labelledby="modalTambahSuratKPTLbl" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahSuratKPTLbl">Tambah Surat Keterangan
                                                Penghasilan Tetap</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('suratkpt.store') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nama_yang_bersangkutan">Nama Yang
                                                                Bersangkutan</label>
                                                            <input type="text" class="form-control"
                                                                id="nama_yang_bersangkutan" name="nama_yang_bersangkutan"
                                                                value="{{ old('nama_yang_bersangkutan') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nik">NIK</label>
                                                            <input type="text" class="form-control" id="nik"
                                                                name="nik" value="{{ old('nik') }}" maxlength="16"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tempat_lahir">Tempat Lahir</label>
                                                            <input type="text" class="form-control" id="tempat_lahir"
                                                                name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tanggal_lahir"
                                                                name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                                            <select class="form-control" id="jenis_kelamin"
                                                                name="jenis_kelamin" required>
                                                                <option value="">Pilih Jenis Kelamin</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="agama">Agama</label>
                                                            <select class="form-control" id="agama" name="agama"
                                                                required>
                                                                <option value="">Pilih Agama</option>
                                                                <option value="Islam">Islam</option>
                                                                <option value="Kristen">Kristen</option>
                                                                <option value="Katholik">Katholik</option>
                                                                <option value="Hindu">Hindu</option>
                                                                <option value="Buddha">Buddha</option>
                                                                <option value="Konghucu">Konghucu</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pekerjaan">Pekerjaan</label>
                                                            <input type="text" class="form-control" id="pekerjaan"
                                                                name="pekerjaan" value="{{ old('pekerjaan') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="alamat_yang_bersangkutan">Alamat Yang
                                                                Bersangkutan</label>
                                                            <textarea class="form-control" id="alamat_yang_bersangkutan" name="alamat_yang_bersangkutan" required>{{ old('alamat_yang_bersangkutan') }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_ayah">Nama Ayah</label>
                                                            <input type="text" class="form-control" id="nama_ayah"
                                                                name="nama_ayah" value="{{ old('nama_ayah') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_ibu">Nama Ibu</label>
                                                            <input type="text" class="form-control" id="nama_ibu"
                                                                name="nama_ibu" value="{{ old('nama_ibu') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pekerjaan_orang_tua">Pekerjaan Orang Tua</label>
                                                            <input type="text" class="form-control"
                                                                id="pekerjaan_orang_tua" name="pekerjaan_orang_tua"
                                                                value="{{ old('pekerjaan_orang_tua') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="penghasilan_per_bulan">Penghasilan Per
                                                                Bulan</label>
                                                            <input type="number" class="form-control"
                                                                id="penghasilan_per_bulan" name="penghasilan_per_bulan"
                                                                value="{{ old('penghasilan_per_bulan') }}" min="0"
                                                                step="1000" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="keperluan">Keperluan</label>
                                                            <input type="text" class="form-control" id="keperluan"
                                                                name="keperluan" value="{{ old('keperluan') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan</label>
                                                            <textarea class="form-control" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Tambah Surat KPT --}}

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Surat</th>
                                            <th>Nama Bersangkutan</th>
                                            <th>NIK</th>
                                            <th>Tempat/Tgl Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Agama</th>
                                            <th>Pekerjaan</th>
                                            <th>Penghasilan/Bulan</th>
                                            <th>Keperluan</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suratKpt as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->no_surat }}</td>
                                                <td>{{ $row->nama_yang_bersangkutan }}</td>
                                                <td>{{ $row->nik }}</td>
                                                <td>{{ $row->tempat_lahir }},
                                                    {{ \Carbon\Carbon::parse($row->tanggal_lahir)->format('d-m-Y') }}</td>
                                                <td>{{ $row->jenis_kelamin }}</td>
                                                <td>{{ $row->agama }}</td>
                                                <td>{{ $row->pekerjaan }}</td>
                                                <td>Rp {{ number_format($row->penghasilan_per_bulan, 0, ',', '.') }}</td>
                                                <td>{{ $row->keperluan }}</td>
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
                                                    <div class="d-flex flex-column align-items-start">
                                                        <div class="d-flex align-items-center gap-2">
                                                            {{-- Tombol Edit --}}
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $row->id }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </button>

                                                            {{-- Tombol Hapus --}}
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $row->id }}">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </div>

                                                        {{-- Form Export di bawah --}}
                                                        <form action="{{ route('suratkpt.export.pdf', $row->id) }}"
                                                            method="GET" class="w-100 mt-2">
                                                            <button type="submit" class="btn btn-success btn-sm w-100">
                                                                <i class="fas fa-file-pdf"></i> Export
                                                            </button>
                                                        </form>
                                                    </div>
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
                                                                Apakah Anda yakin ingin menghapus Surat KPT untuk
                                                                {{ $row->nama_yang_bersangkutan }}?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <form action="{{ route('suratkpt.destroy', $row->id) }}"
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
                                                <div class="modal-dialog modal-lg">
                                                    <form action="{{ route('suratkpt.update', $row->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Surat KPT</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="nomor_manual">Nomor Surat (manual)</label>
                                                                    <input type="number" name="nomor_manual"
                                                                        class="form-control"
                                                                        placeholder="Masukkan nomor surat (misal: 101)">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Nama Yang Bersangkutan</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nama_yang_bersangkutan"
                                                                                value="{{ $row->nama_yang_bersangkutan }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>NIK</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nik"
                                                                                value="{{ $row->nik }}"
                                                                                maxlength="16" required>
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
                                                                                value="{{ $row->tanggal_lahir }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Jenis Kelamin</label>
                                                                            <select class="form-control"
                                                                                name="jenis_kelamin" required>
                                                                                <option value="Laki-laki"
                                                                                    {{ $row->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                                                                                    Laki-laki</option>
                                                                                <option value="Perempuan"
                                                                                    {{ $row->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                                                                                    Perempuan</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Agama</label>
                                                                            <select class="form-control" name="agama"
                                                                                required>
                                                                                <option value="Islam"
                                                                                    {{ $row->agama == 'Islam' ? 'selected' : '' }}>
                                                                                    Islam</option>
                                                                                <option value="Kristen"
                                                                                    {{ $row->agama == 'Kristen' ? 'selected' : '' }}>
                                                                                    Kristen</option>
                                                                                <option value="Katholik"
                                                                                    {{ $row->agama == 'Katholik' ? 'selected' : '' }}>
                                                                                    Katholik</option>
                                                                                <option value="Hindu"
                                                                                    {{ $row->agama == 'Hindu' ? 'selected' : '' }}>
                                                                                    Hindu</option>
                                                                                <option value="Buddha"
                                                                                    {{ $row->agama == 'Buddha' ? 'selected' : '' }}>
                                                                                    Buddha</option>
                                                                                <option value="Konghucu"
                                                                                    {{ $row->agama == 'Konghucu' ? 'selected' : '' }}>
                                                                                    Konghucu</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pekerjaan</label>
                                                                            <input type="text" class="form-control"
                                                                                name="pekerjaan"
                                                                                value="{{ $row->pekerjaan }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Alamat Yang Bersangkutan</label>
                                                                            <textarea class="form-control" name="alamat_yang_bersangkutan" required>{{ $row->alamat_yang_bersangkutan }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Nama Ayah</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nama_ayah"
                                                                                value="{{ $row->nama_ayah }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Nama Ibu</label>
                                                                            <input type="text" class="form-control"
                                                                                name="nama_ibu"
                                                                                value="{{ $row->nama_ibu }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Pekerjaan Orang Tua</label>
                                                                            <input type="text" class="form-control"
                                                                                name="pekerjaan_orang_tua"
                                                                                value="{{ $row->pekerjaan_orang_tua }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Penghasilan Per Bulan</label>
                                                                            <input type="number" class="form-control"
                                                                                name="penghasilan_per_bulan"
                                                                                value="{{ $row->penghasilan_per_bulan }}"
                                                                                min="0" step="1000" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Keperluan</label>
                                                                            <input type="text" class="form-control"
                                                                                name="keperluan"
                                                                                value="{{ $row->keperluan }}" required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Keterangan</label>
                                                                            <textarea class="form-control" name="keterangan">{{ $row->keterangan }}</textarea>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Status</label>
                                                                            <select class="form-control" name="status"
                                                                                required>
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
