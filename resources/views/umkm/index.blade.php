@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman UMKM</h3>

                    <div class="card">
                        <div class="card-header">
                            <h5>Data UMKM</h5>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahUMKM">
                                    <i class="fas fa-plus-circle"></i> Tambah UMKM
                                </button>

                                {{-- Filter --}}
                                <div class="d-flex gap-2">
                                    <form method="GET" action="{{ route('umkm.index') }}" class="d-flex gap-2">
                                        <select name="status" class="form-control" onchange="this.form.submit()">
                                            <option value="">Semua Status</option>
                                            @foreach ($statusOptions as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ request('status') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <select name="kategori" class="form-control" onchange="this.form.submit()">
                                            <option value="">Semua Kategori</option>
                                            @foreach ($kategoriOptions as $key => $label)
                                                <option value="{{ $key }}"
                                                    {{ request('kategori') == $key ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>

                            {{-- Modal Tambah UMKM --}}
                            <div class="modal fade" id="modalTambahUMKM" tabindex="-1" role="dialog"
                                aria-labelledby="modalTambahUMKMLbl" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTambahUMKMLbl">Tambah UMKM</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('umkm.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nik">NIK <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" id="nik" name="nik"
                                                                required>
                                                                <option value="">Pilih NIK</option>
                                                                @foreach ($penduduks as $penduduk)
                                                                    <option value="{{ $penduduk->nik }}"
                                                                        {{ old('nik') == $penduduk->nik ? 'selected' : '' }}>
                                                                        {{ $penduduk->nik }} -
                                                                        {{ $penduduk->nama_lengkap }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_usaha">Nama Usaha <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="nama_usaha"
                                                                name="nama_usaha" value="{{ old('nama_usaha') }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kategori">Kategori <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control" id="kategori" name="kategori"
                                                                required>
                                                                <option value="">Pilih Kategori</option>
                                                                @foreach ($kategoriOptions as $key => $label)
                                                                    <option value="{{ $key }}"
                                                                        {{ old('kategori') == $key ? 'selected' : '' }}>
                                                                        {{ $label }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_produk">Nama Produk <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="nama_produk"
                                                                name="nama_produk" value="{{ old('nama_produk') }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nomor_telepon">Nomor Telepon/WhatsApp <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" id="nomor_telepon"
                                                                name="nomor_telepon" value="{{ old('nomor_telepon') }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="deskripsi_produk">Deskripsi Produk <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" rows="3" required>{{ old('deskripsi_produk') }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="foto_produk">Foto Produk <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="file" class="form-control" id="foto_produk"
                                                                name="foto_produk" accept=".jpg,.jpeg,.png" required>
                                                            <small class="text-muted">Format: JPG/PNG/JPEG, Max:
                                                                2MB</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="link_facebook">Link Facebook</label>
                                                            <input type="url" class="form-control" id="link_facebook"
                                                                name="link_facebook" value="{{ old('link_facebook') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="link_instagram">Link Instagram</label>
                                                            <input type="url" class="form-control"
                                                                id="link_instagram" name="link_instagram"
                                                                value="{{ old('link_instagram') }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="link_tiktok">Link TikTok</label>
                                                            <input type="url" class="form-control" id="link_tiktok"
                                                                name="link_tiktok" value="{{ old('link_tiktok') }}">
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
                            {{-- End Modal Tambah UMKM --}}

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Nama Pemilik</th>
                                            <th>Nama Usaha</th>
                                            <th>Kategori</th>
                                            <th>Nama Produk</th>
                                            <th>Foto Produk</th>
                                            <th>Kontak</th>
                                            <th>Status</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($umkms as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->nik }}</td>
                                                <td>{{ $row->penduduk->nama_lengkap ?? 'N/A' }}</td>
                                                <td>{{ $row->nama_usaha }}</td>
                                                <td>{{ $row->kategori_label }}</td>
                                                <td>{{ $row->nama_produk }}</td>
                                                <td>
                                                    @if ($row->foto_produk)
                                                        <img src="{{ asset('storage/' . $row->foto_produk) }}"
                                                            alt="Foto Produk" class="img-thumbnail"
                                                            style="max-width: 80px; max-height: 80px; cursor: pointer;"
                                                            onclick="showImageModal('{{ asset('storage/' . $row->foto_produk) }}', '{{ $row->nama_produk }}')">
                                                    @else
                                                        <span class="text-muted">Tidak ada foto</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small>
                                                        <strong>HP:</strong> {{ $row->nomor_telepon }}<br>
                                                        @if ($row->link_facebook)
                                                            <a href="{{ $row->link_facebook }}" target="_blank"
                                                                class="text-primary">
                                                                <i class="fab fa-facebook"></i>
                                                            </a>
                                                        @endif
                                                        @if ($row->link_instagram)
                                                            <a href="{{ $row->link_instagram }}" target="_blank"
                                                                class="text-danger">
                                                                <i class="fab fa-instagram"></i>
                                                            </a>
                                                        @endif
                                                        @if ($row->link_tiktok)
                                                            <a href="{{ $row->link_tiktok }}" target="_blank"
                                                                class="text-dark">
                                                                <i class="fab fa-tiktok"></i>
                                                            </a>
                                                        @endif
                                                    </small>
                                                </td>
                                                <td>
                                                    <span class="badge badge-{{ $row->status_badge }}">
                                                        {{ $row->status_label }}
                                                    </span>
                                                    @if ($row->status === 'approved' && $row->approved_at)
                                                        <br><small
                                                            class="text-muted">{{ $row->approved_at->format('d/m/Y') }}</small>
                                                    @endif
                                                </td>
                                                <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <div class="d-flex flex-column align-items-start">
                                                        {{-- Tombol Status Actions --}}
                                                        @if ($row->status === 'pending')
                                                            <div class="btn-group mb-1" role="group">
                                                                <button type="button" class="btn btn-success btn-sm"
                                                                    onclick="approveUmkm({{ $row->id }}, '{{ $row->nama_usaha }}')">
                                                                    <i class="fas fa-check"></i> Setujui
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    data-toggle="modal"
                                                                    data-target="#rejectModal{{ $row->id }}">
                                                                    <i class="fas fa-times"></i> Tolak
                                                                </button>
                                                            </div>
                                                        @elseif($row->status === 'rejected')
                                                            <button type="button" class="btn btn-info btn-sm mb-1"
                                                                onclick="resetToPending({{ $row->id }}, '{{ $row->nama_usaha }}')">
                                                                <i class="fas fa-redo"></i> Reset ke Pending
                                                            </button>
                                                        @endif

                                                        {{-- Tombol CRUD --}}
                                                        <div class="d-flex align-items-center gap-1">
                                                            <button type="button" class="btn btn-info btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#detailModal{{ $row->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $row->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#deleteModal{{ $row->id }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center">Tidak ada data UMKM</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{-- End Table --}}

                            {{-- SEMUA MODAL DIPINDAHKAN KE SINI --}}
                            @foreach ($umkms as $row)
                                {{-- Modal Detail --}}
                                <div class="modal fade" id="detailModal{{ $row->id }}" tabindex="-1"
                                    aria-labelledby="detailModalLabel{{ $row->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $row->id }}">Detail
                                                    UMKM - {{ $row->nama_usaha }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td><strong>NIK:</strong></td>
                                                                <td>{{ $row->nik }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Nama Pemilik:</strong></td>
                                                                <td>{{ $row->penduduk->nama_lengkap ?? 'N/A' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Nama Usaha:</strong></td>
                                                                <td>{{ $row->nama_usaha }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Kategori:</strong></td>
                                                                <td>{{ $row->kategori_label }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Nama Produk:</strong></td>
                                                                <td>{{ $row->nama_produk }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>No. Telepon:</strong></td>
                                                                <td>{{ $row->nomor_telepon }}</td>
                                                            </tr>
                                                            @if ($row->link_facebook)
                                                                <tr>
                                                                    <td><strong>Facebook:</strong></td>
                                                                    <td><a href="{{ $row->link_facebook }}"
                                                                            target="_blank">{{ $row->link_facebook }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            @if ($row->link_instagram)
                                                                <tr>
                                                                    <td><strong>Instagram:</strong></td>
                                                                    <td><a href="{{ $row->link_instagram }}"
                                                                            target="_blank">{{ $row->link_instagram }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            @if ($row->link_tiktok)
                                                                <tr>
                                                                    <td><strong>TikTok:</strong></td>
                                                                    <td><a href="{{ $row->link_tiktok }}"
                                                                            target="_blank">{{ $row->link_tiktok }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if ($row->foto_produk)
                                                            <img src="{{ asset('storage/' . $row->foto_produk) }}"
                                                                alt="Foto Produk" class="img-fluid rounded">
                                                        @else
                                                            <div class="text-center text-muted">
                                                                <i class="fas fa-image fa-3x"></i>
                                                                <p>Tidak ada foto</p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <strong>Deskripsi Produk:</strong>
                                                    <p>{{ $row->deskripsi_produk }}</p>
                                                </div>
                                                @if ($row->status === 'rejected' && $row->catatan_admin)
                                                    <div class="alert alert-danger mt-3">
                                                        <strong>Catatan Admin:</strong><br>
                                                        {{ $row->catatan_admin }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Reject --}}
                                @if ($row->status === 'pending')
                                    <div class="modal fade" id="rejectModal{{ $row->id }}" tabindex="-1"
                                        aria-labelledby="rejectModalLabel{{ $row->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rejectModalLabel{{ $row->id }}">
                                                        Tolak UMKM</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('umkm.reject', $row->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menolak UMKM
                                                            <strong>{{ $row->nama_usaha }}</strong>?
                                                        </p>
                                                        <div class="form-group">
                                                            <label>Catatan Penolakan <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control" name="catatan_admin" rows="3" required
                                                                placeholder="Berikan alasan penolakan..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Modal Konfirmasi Hapus --}}
                                <div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $row->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $row->id }}">
                                                    Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus UMKM
                                                <strong>{{ $row->nama_usaha }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <form action="{{ route('umkm.destroy', $row->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $row->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{ route('umkm.update', $row->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $row->id }}">Edit
                                                        UMKM</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>NIK <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="nik" required>
                                                                    @foreach ($penduduks as $penduduk)
                                                                        <option value="{{ $penduduk->nik }}"
                                                                            {{ $row->nik == $penduduk->nik ? 'selected' : '' }}>
                                                                            {{ $penduduk->nik }} -
                                                                            {{ $penduduk->nama_lengkap }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Usaha <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="nama_usaha" value="{{ $row->nama_usaha }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Kategori <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="kategori" required>
                                                                    @foreach ($kategoriOptions as $key => $label)
                                                                        <option value="{{ $key }}"
                                                                            {{ $row->kategori == $key ? 'selected' : '' }}>
                                                                            {{ $label }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nama Produk <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="nama_produk" value="{{ $row->nama_produk }}"
                                                                    required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Nomor Telepon/WhatsApp <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="nomor_telepon"
                                                                    value="{{ $row->nomor_telepon }}" required>
                                                            </div>
                                                            {{-- TAMBAHAN: Control Status untuk Admin --}}
                                                            <div class="form-group">
                                                                <label>Status UMKM <span
                                                                        class="text-danger">*</span></label>
                                                                <select class="form-control" name="status" required>
                                                                    @foreach ($statusOptions as $key => $label)
                                                                        <option value="{{ $key }}"
                                                                            {{ $row->status == $key ? 'selected' : '' }}>
                                                                            {{ $label }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <small class="text-muted">
                                                                    <i class="fas fa-info-circle"></i>
                                                                    Admin dapat mengubah status UMKM secara langsung
                                                                </small>
                                                            </div>
                                                            {{-- Catatan Admin untuk Rejection --}}
                                                            <div class="form-group" id="catatanGroup{{ $row->id }}"
                                                                style="{{ $row->status == 'rejected' ? 'display: block;' : 'display: none;' }}">
                                                                <label>Catatan Admin</label>
                                                                <textarea class="form-control" name="catatan_admin" rows="3"
                                                                    placeholder="Berikan alasan jika status ditolak...">{{ $row->catatan_admin }}</textarea>
                                                                <small class="text-muted">
                                                                    <i class="fas fa-exclamation-triangle"></i>
                                                                    Wajib diisi jika status diubah ke "Ditolak"
                                                                </small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Deskripsi Produk <span
                                                                        class="text-danger">*</span></label>
                                                                <textarea class="form-control" name="deskripsi_produk" rows="3" required>{{ $row->deskripsi_produk }}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Foto Produk</label>
                                                                <input type="file" class="form-control"
                                                                    name="foto_produk" accept=".jpg,.jpeg,.png">
                                                                @if ($row->foto_produk)
                                                                    <small>Foto saat ini:
                                                                        <img src="{{ asset('storage/' . $row->foto_produk) }}"
                                                                            alt="Current" style="max-height: 50px;"
                                                                            class="mt-1">
                                                                    </small>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Link Facebook</label>
                                                                <input type="url" class="form-control"
                                                                    name="link_facebook"
                                                                    value="{{ $row->link_facebook }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Link Instagram</label>
                                                                <input type="url" class="form-control"
                                                                    name="link_instagram"
                                                                    value="{{ $row->link_instagram }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Link TikTok</label>
                                                                <input type="url" class="form-control"
                                                                    name="link_tiktok" value="{{ $row->link_tiktok }}">
                                                            </div>

                                                            {{-- Info Status Saat Ini --}}
                                                            <div class="alert alert-info">
                                                                <strong><i class="fas fa-info-circle"></i> Status Saat
                                                                    Ini:</strong><br>
                                                                <span
                                                                    class="badge badge-{{ $row->status_badge }} badge-lg">
                                                                    {{ $row->status_label }}
                                                                </span>
                                                                @if ($row->approved_at)
                                                                    <br><small>Disetujui:
                                                                        {{ $row->approved_at->format('d/m/Y H:i') }}</small>
                                                                @endif
                                                                @if ($row->approvedBy)
                                                                    <br><small>Oleh: {{ $row->approvedBy->name }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> Simpan Perubahan
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Preview Gambar --}}
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalTitle">Preview Foto</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="imageModalContent" src="" alt="Preview" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Function untuk preview gambar
        function showImageModal(imageUrl, title) {
            document.getElementById('imageModalContent').src = imageUrl;
            document.getElementById('imageModalTitle').textContent = 'Foto Produk - ' + title;
            $('#imageModal').modal('show');
        }

        // Function untuk approve UMKM dengan SweetAlert
        function approveUmkm(id, namaUsaha) {
            Swal.fire({
                title: 'Konfirmasi Persetujuan',
                html: `Apakah Anda yakin ingin menyetujui UMKM<br><strong>"${namaUsaha}"</strong>?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-check"></i> Ya, Setujui',
                cancelButtonText: '<i class="fas fa-times"></i> Batal',
                reverseButtons: true,
                focusConfirm: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Sedang menyetujui UMKM',
                        icon: 'info',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/umkm/' + id + '/approve';

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    form.appendChild(csrfToken);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Function untuk reset ke pending dengan SweetAlert
        function resetToPending(id, namaUsaha) {
            Swal.fire({
                title: 'Konfirmasi Reset Status',
                html: `Apakah Anda yakin ingin reset status UMKM<br><strong>"${namaUsaha}"</strong><br>ke <span class="badge badge-warning">Pending</span>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-redo"></i> Ya, Reset',
                cancelButtonText: '<i class="fas fa-times"></i> Batal',
                reverseButtons: true,
                focusConfirm: false,
                customClass: {
                    confirmButton: 'btn btn-info',
                    cancelButton: 'btn btn-secondary'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Sedang reset status UMKM',
                        icon: 'info',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/umkm/' + id + '/reset';

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    form.appendChild(csrfToken);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Auto submit form ketika filter berubah
        document.addEventListener('DOMContentLoaded', function() {
            // Select2 untuk dropdown NIK jika tersedia
            if (typeof $.fn.select2 !== 'undefined') {
                $('#nik').select2({
                    placeholder: 'Pilih NIK',
                    allowClear: true,
                    width: '100%'
                });
            }

            // Show success/error message jika ada
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'OK'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    title: 'Validation Error!',
                    html: '<ul style="text-align: left;">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                    icon: 'error',
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
@endpush
