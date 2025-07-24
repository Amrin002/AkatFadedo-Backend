@extends('template.main')

@section('content')
<div class="container">
    <div class="page-inner">
    <div class="row">
    <div class="col">
    <h3>Daftar Keluhan</h3>

    {{-- Button Tambah Keluhan --}}
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahKeluhanModal">
        <i class="fas fa-plus-circle"></i> Tambah Keluhan
    </button>

    {{-- Filter --}}
    <form method="GET" class="mb-3">
        <div class="input-group w-50">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button class="btn btn-secondary">Filter</button>
        </div>
    </form>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tabel --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Isi Keluhan</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th>Pengirim</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($keluhan as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('keluhan.show', $item) }}">{{ $item->judul }}</a>
                        </td>
                        <td>{{ Str::limit($item->isi, 50) }}</td>
                        
                        {{-- Gambar jika ada --}}

                         <td>
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Keluhan" width="80">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>



                        <td>
                            <span class="badge
                                {{ $item->status == 'pending' ? 'bg-warning text-dark' :
                                    ($item->status == 'diproses' ? 'bg-primary' : 'bg-success') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>{{ $item->user->name ?? 'Anonim' }}</td>
                        <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                        <td>
                        <div class="d-flex flex-column gap-2">
                            
                            {{-- Tombol Lihat --}}
                            <a href="{{ route('keluhan.show', $item->id) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i> Lihat Keluhan
                            </a>

                            {{-- Tanggapi (jika admin & status pending) --}}
                            @if (auth()->user()->role === 'admin' && $item->status == 'pending')
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#tanggapiModal{{ $item->id }}">
                                    Tanggapi
                                </button>

                                <!-- Modal Tanggapi -->
                                <div class="modal fade" id="tanggapiModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('keluhan.tanggapi', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $item->id }}">Tanggapi Keluhan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="respon_admin_{{ $item->id }}">Tanggapan</label>
                                                        <textarea id="respon_admin_{{ $item->id }}" name="respon_admin" class="form-control"
                                                            rows="4" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Tandai Diproses</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            {{-- Tandai selesai --}}
                            @if (auth()->user()->role === 'admin' && $item->status == 'diproses')
                                <form action="{{ route('keluhan.selesaikan', $item) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-success">Selesai</button>
                                </form>
                            @endif

                           {{-- Tombol Edit --}}
                                @if (auth()->id() === $item->user_id || auth()->user()->role === 'admin')
                                    <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>
                                @endif


                            {{-- Tombol Hapus --}}
                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusModal{{ $item->id }}">
                                Hapus
                            </button>

                            {{-- Modal Hapus --}}
                            <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="hapusModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content border-danger">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="hapusModalLabel{{ $item->id }}">Hapus Keluhan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin ingin menghapus keluhan <strong>{{ $item->judul }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('keluhan.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada keluhan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah --}}
<div class="modal fade" id="tambahKeluhanModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('keluhan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Keluhan Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="judul">Judul Keluhan</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="isi">Isi Keluhan</label>
                        <textarea name="isi" rows="4" class="form-control" required></textarea>
                    </div>

                     <div class="mb-3">
                    <label for="gambar">Upload Gambar (opsional)</label>
                    <input type="file" name="gambar" class="form-control-file" accept="image/*">
                </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Kirim Keluhan</button>
                </div>
            </form>
        </div>
        </div>
        </div>

        {{-- Modal Edit --}}
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
    aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('keluhan.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="editModalLabel{{ $item->id }}">Edit Keluhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="judul{{ $item->id }}">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul{{ $item->id }}"
                            value="{{ $item->judul }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="isi{{ $item->id }}">Isi Keluhan</label>
                        <textarea name="isi" class="form-control" id="isi{{ $item->id }}" rows="4" required>{{ $item->isi }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="gambar{{ $item->id }}">Ganti Gambar (opsional)</label>
                        <input type="file" name="gambar" class="form-control" id="gambar{{ $item->id }}">
                        @if ($item->gambar)
                            <p class="mt-2">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $item->gambar) }}" width="100">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


    </div>
    </div>
</div>
@endsection
