@extends('template.main')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col">
                <h3>Daftar Keluhan</h3>

                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahKeluhanModal">
                    <i class="fas fa-plus-circle"></i> Tambah Keluhan
                </button>

                <!-- Modal Tambah Keluhan -->
                <div class="modal fade" id="tambahKeluhanModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ route('keluhan.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Form Tambah Keluhan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="judul">Judul Keluhan</label>
                                        <input type="text" name="judul" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="isi">Isi Keluhan</label>
                                        <textarea name="isi" class="form-control" rows="4" required></textarea>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Kirim Keluhan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif




                <form method="GET" class="mb-3">
                    <select name="status" class="form-control w-25 d-inline">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button class="btn btn-secondary">Filter</button>
                </form>

                @foreach ($keluhan as $item)
                    <div class="card shadow-sm mb-3">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <h5><a href="{{ route('keluhan.show', $item) }}">{{ $item->judul }}</a></h5>
                                <p class="text-muted">{{ Str::limit($item->isi, 100) }}</p>
                                <small>Dikirim oleh: <strong>{{ $item->user->name ?? 'Anonim' }}</strong> - {{ $item->created_at->format('d M Y') }}</small>
                            </div>
                            <div>
                                <span class="badge
                                    {{ $item->status == 'pending' ? 'bg-warning text-dark' :
                                        ($item->status == 'diproses' ? 'bg-primary' : 'bg-success') }}">
                                    {{ ucfirst($item->status) }}
                                </span>

                                @if (auth()->user()->role == 'admin' && $item->status == 'pending')
                                <!-- Tombol -->
                                <button class="btn btn-sm btn-outline-primary mt-2" data-toggle="modal"
                                    data-target="#tanggapiModal{{ $item->id }}">Tanggapi</button>

                                <!-- Modal -->
                                <div class="modal fade" id="tanggapiModal{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    <form action="{{ route('keluhan.tanggapi', $item) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                        <h5 class="modal-title">Tanggapi Keluhan</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="form-group">
                                            <label for="respon_admin">Tanggapan</label>
                                            <textarea name="respon_admin" class="form-control" rows="4" required></textarea>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary">Tandai Diproses</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                                @endif

                                @if (auth()->user()->role == 'admin' && $item->status == 'diproses')
                                    <form action="{{ route('keluhan.selesaikan', $item) }}" method="POST" class="mt-2">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success">Selesaikan</button>
                                    </form>
                                @endif


                                @if (auth()->user()->role == 'admin')
                                <form action="{{ route('keluhan.destroy', $item->id) }}" method="POST" class="mt-2"
                                    onsubmit="return confirm('Yakin ingin menghapus keluhan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" data-toggle="modal"
                                    data-target="#hapusKeluhanModal{{ $item->id }}">
                                    <i class="fas fa-trash"></i>
                                    Hapus
                                    </button>

                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="hapusKeluhanModal{{ $item->id }}" tabindex="-1"
                    aria-labelledby="hapusKeluhanLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-danger">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="hapusKeluhanLabel{{ $item->id }}">
                                    Konfirmasi Hapus
                                </h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin menghapus keluhan <strong>"{{ $item->judul }}"</strong>?
                                Tindakan ini tidak dapat dibatalkan.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    Batal
                                </button>
                                <form action="{{ route('keluhan.destroy', $item->id) }}" method="POST">
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

                @endforeach

                @if ($keluhan->isEmpty())
                    <div class="alert alert-info">Belum ada keluhan.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
