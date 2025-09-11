@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Daftar Berita</h3>
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Data Berita</h5>

                            {{-- Filter Kategori --}}
                            <form action="{{ route('berita.index') }}" method="GET" class="form-inline align-items-center">
                                <label for="kategori" class="mr-2">Filter Kategori:</label>
                            
                                <div class="d-flex align-items-center">
                                    <select name="kategori" id="kategori" class="form-control mr-2" onchange="this.form.submit()">
                                        <option value="" data-icon="">-- Semua Kategori --</option>
                                        @foreach ($kategori as $kat)
                                            <option value="{{ $kat['nama'] }}" 
                                                    data-icon="{{ $kat['icon'] }}"
                                                    {{ request('kategori') == $kat['nama'] ? 'selected' : '' }}>
                                                {{ $kat['nama'] }}
                                            </option>
                                        @endforeach
                                    </select>
                            
                                    {{-- Tempat tampilkan icon --}}
                                    <span id="kategoriIcon" class="ml-2" style="font-size: 1.2rem;"></span>
                                </div>
                            
                                @if (request('kategori'))
                                    <a href="{{ route('berita.index') }}" class="btn btn-secondary btn-sm ml-2">Reset</a>
                                @endif
                            </form>
                        </div>

                        <div class="card-body">
                            {{-- Alert Success --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Tombol Tambah Berita --}}
                            <a href="{{ route('berita.create') }}" class="btn btn-success mb-3">
                                <i class="fas fa-plus-circle"></i> Tambah Berita
                            </a>

                            {{-- Table data berita --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Gambar</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Konten</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Penulis</th>
                                            <th scope="col">Tanggal Dibuat</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($berita as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($row->gambar)
                                                        <img src="{{ asset('storage/' . $row->gambar) }}" width="100"
                                                            class="img-thumbnail">
                                                    @else
                                                        <p>Tidak ada gambar</p>
                                                    @endif
                                                </td>
                                                <td>{{ $row->judul }}</td>
                                                <td>{!! Str::limit(strip_tags($row->konten), 50) !!}</td>
                                                <td>
                                                    {{-- tampilkan kategori langsung dari field string --}}
                                                    {{ $row->kategori ?? '-' }}
                                                </td>
                                                <td>{{ $row->user->name ?? 'Admin' }}</td>
                                                <td>{{ $row->created_at->format('d - m - Y') }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('berita.edit', $row->id) }}"
                                                            class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#deleteBeritaModal{{ $row->id }}">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div class="modal fade" id="deleteBeritaModal{{ $row->id }}" tabindex="-1"
                                                aria-labelledby="deleteBeritaModalLabel{{ $row->id }}"
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
                                                                <button type="submit" class="btn btn-danger">Ya,
                                                                    Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada berita ditemukan</td>
                                            </tr>
                                        @endforelse
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

{{-- script untuk preview icon --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const select = document.getElementById("kategori");
        const iconSpan = document.getElementById("kategoriIcon");

        function updateIcon() {
            const selectedOption = select.options[select.selectedIndex];
            const iconClass = selectedOption.getAttribute("data-icon");

            if (iconClass) {
                iconSpan.innerHTML = `<i class="${iconClass}"></i>`;
            } else {
                iconSpan.innerHTML = "";
            }
        }

        updateIcon();
        select.addEventListener("change", updateIcon);
    });
</script>
