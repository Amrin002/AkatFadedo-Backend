@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman APBDes</h3>

                    <div class="card">
                        <div class="card-header">
                            <h5>Data APBDes</h5>
                        </div>

                        <div class="card-body">
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modalTambahAPBDES">
                                <i class="fas fa-plus-circle"></i> Tambah APBDes
                            </button>

                            {{-- Modal Tambah APBDes --}}
                            <div class="modal fade" id="modalTambahAPBDES" tabindex="-1" role="dialog"
                                aria-labelledby="modalTambahAPBDESLbl" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahAPBDESLbl">Tambah APBDes</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('apbdes.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="pendapatan">Pendapatan</label>
                                                    <input type="number" class="form-control" id="pendapatan"
                                                    name="pendapatan" value="{{ old('pendapatan') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="penyelenggaraan">Bidang Penyelenggaraan Pemerintahan Desa</label>
                                                    <input type="number" class="form-control" id="penyelenggaraan"
                                                        name="penyelenggaraan" value="{{ old('penyelenggaraan') }}"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pelaksanaan">Bidang Pelaksanaan Pembangunan Desa</label>
                                                    <input type="number" class="form-control" id="pelaksanaan"
                                                        name="pelaksanaan" value="{{ old('pelaksanaan') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pembinaan">Bidang Pembinaan Kemasyarakatan</label>
                                                    <input type="number" class="form-control" id="pembinaan"
                                                        name="pembinaan" value="{{ old('pembinaan') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pemberdayaan">Bidang Pemberdayaan Kemasyarakatan</label>
                                                    <input type="number" class="form-control" id="pemberdayaan"
                                                        name="pemberdayaan" value="{{ old('pemberdayaan') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="penanggulangan">Bidang Penanggulangan Bencana Darurat dan
                                                        Mendesak</label>
                                                    <input type="number" class="form-control" id="penanggulangan"
                                                        name="penanggulangan" value="{{ old('penanggulangan') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pejabat">Pejabat Kepala Desa</label>
                                                    <input type="text" class="form-control" id="pejabat"
                                                        name="pejabat" value="{{ old('pejabat') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tahun">Tahun</label>
                                                    <input type="number" class="form-control" id="tahun" name="tahun"
                                                        value="{{ old('tahun') }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="file">File "PNG/JPG/JPEG", Size Max = 2Mb</label>
                                                    <input type="file" class="form-control" name="file"
                                                        accept=".jpg,.jpeg,.png">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Tambah Data APBDes --}}

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pendapatan</th>
                                            <th>Bidang Penyelenggaraan Pemerintahan Desa</th>
                                            <th>Bidang pelaksanaan Pembangunan Desa</th>
                                            <th>Bidang pembinaan Kemasyarakatan</th>
                                            <th>Bidang Pemberdayaan Kemasyarakatan</th>
                                            <th>Bidang Penanggulangan Bencana Darurat dan Mendesak</th>
                                            <th>Pejabat Kepala Desa</th>
                                            <th>Tahun</th>
                                            <th>File Gambar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($apbdes as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>Rp. {{ number_format($row->pendapatan, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($row->penyelenggaraan, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($row->pelaksanaan, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($row->pembinaan, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($row->pemberdayaan, 0, ',', '.') }}</td>
                                                <td>Rp. {{ number_format($row->penanggulangan, 0, ',', '.') }}</td>
                                                <td>{{ $row->pejabat }}</td>
                                                <td>{{ $row->tahun }}</td>
                                                <td>
                                                    @if ($row->file)
                                                        <img src="{{ asset('storage/' . $row->file) }}" alt="Gambar APBDes"
                                                            style="max-width: 100px; max-height: 100px;">
                                                    @else
                                                        <span>Tidak ada gambar</span>
                                                    @endif
                                                </td>
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
                                                                Apakah Anda yakin ingin menghapus Data ini
                                                                ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <form action="{{ route('apbdes.destroy', $row->id) }}"
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
                                                    <form action="{{ route('apbdes.update', $row->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit APBDes</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label>Pendapatan</label>
                                                                    <input type="number" class="form-control" name="pendapatan" value="{{ $row->pendapatan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Bidang Penyelenggaraan Pemerintahan Desa</label>
                                                                    <input type="number" class="form-control"
                                                                        name="penyelenggaraan"
                                                                        value="{{ $row->penyelenggaraan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Bidang Pelaksanaan Pembangunan Desa</label>
                                                                    <input type="number" class="form-control"
                                                                        name="pelaksanaan"
                                                                        value="{{ $row->pelaksanaan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Bidang Pembinaan Kemasyarakatan</label>
                                                                    <input type="number" class="form-control"
                                                                        name="pembinaan" value="{{ $row->pembinaan }}"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Bidang Pemberdayaan Kemasyarakatan</label>
                                                                    <input type="number" class="form-control"
                                                                        name="pemberdayaan"
                                                                        value="{{ $row->pemberdayaan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Bidang Penanggulangan Bencana Darurat dan
                                                                        Mendesak</label>
                                                                    <input type="number" class="form-control"
                                                                        name="penanggulangan"
                                                                        value="{{ $row->penanggulangan }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Pejabat Kepala Desa</label>
                                                                    <input type="text" class="form-control"
                                                                        name="pejabat" value="{{ $row->pejabat }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Tahun</label>
                                                                    <input type="number" class="form-control"
                                                                        name="tahun" value="{{ $row->tahun }}" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>File "PNG/JPG/JPEG", Size Max = 2Mb</label>
                                                                    <input type="file" class="form-control"
                                                                        name="file" accept=".jpg,.jpeg,.png">
                                                                    @if ($row->file)
                                                                        <small>File saat ini: <a
                                                                                href="{{ asset('storage/' . $row->file) }}"
                                                                                target="_blank">{{ $row->file }}</a></small>
                                                                    @endif
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
