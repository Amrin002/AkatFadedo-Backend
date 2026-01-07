@extends("template.main")
@section("content")
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Halaman Galeri Desa</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5>Galeri Desa</h5>
                        </div>
                        <div class="card-body">
                            <a href="{{ route("kegiatan.index") }}" class="btn btn-primary mb-3">
                                <i class="fas fa-folder-plus"></i> Kelola Kegiatan Desa
                            </a>
                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fas fa-plus-circle"></i> Tambah Galeri
                            </button>

                            {{-- Modal Tambah Galeri --}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Galeri</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route("galeri.store") }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama_kegiatan">Nama Kegiatan <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ old("nama_kegiatan") }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Label Kegiatan <span class="text-danger">*</span></label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="kegiatan_option" id="pilihExisting" value="existing" checked>
                                                        <label class="form-check-label" for="pilihExisting">
                                                            Pilih Kegiatan yang Ada
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="kegiatan_option" id="buatBaru" value="new">
                                                        <label class="form-check-label" for="buatBaru">
                                                            Buat Kegiatan Baru
                                                        </label>
                                                    </div>
                                                </div>

                                                {{-- Pilih Kegiatan Existing --}}
                                                <div class="form-group" id="existingKegiatanGroup">
                                                    <label for="kegiatan_desa_id">Pilih Kegiatan</label>
                                                    <select class="form-control" id="kegiatan_desa_id" name="kegiatan_desa_id">
                                                        <option value="">-- Pilih Kegiatan --</option>
                                                        @foreach ($kegiatanList as $kegiatan)
                                                            <option value="{{ $kegiatan->id }}" {{ old("kegiatan_desa_id") == $kegiatan->id ? "selected" : "" }}>
                                                                {{ $kegiatan->judul }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- Form Buat Kegiatan Baru --}}
                                                <div id="newKegiatanGroup" style="display: none;">
                                                    <div class="card bg-light mb-3">
                                                        <div class="card-body">
                                                            <h6 class="card-title">Form Kegiatan Baru</h6>
                                                            <div class="form-group">
                                                                <label for="judul_kegiatan_baru">Judul Kegiatan Baru <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="judul_kegiatan_baru" name="judul_kegiatan_baru" placeholder="Contoh: Perayaan 17 Agustus 2025">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="deskripsi_kegiatan_baru">Deskripsi</label>
                                                                <textarea class="form-control" id="deskripsi_kegiatan_baru" name="deskripsi_kegiatan_baru" rows="3" placeholder="Deskripsi kegiatan (opsional)"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tanggal">Tanggal Foto</label>
                                                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old("tanggal") }}">
                                                            <small class="form-text text-muted">Tanggal pengambilan foto</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="imageGaleri">Foto Kegiatan <span class="text-danger">*</span></label>
                                                            <input type="file" class="form-control-file galeri-image" id="imageGaleri" name="image" accept="image/png, image/jpeg" data-target="previewGaleri" required>
                                                            <!-- Preview Image -->
                                                            <img id="previewGaleri" src="" alt="Preview Foto" class="img-thumbnail mt-2" width="100" style="display: none;">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="keterangan">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Keterangan tambahan (opsional)">{{ old("keterangan") }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save"></i> Simpan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Tambah Data --}}

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Kegiatan</th>
                                            <th scope="col">Label Kegiatan</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Foto Kegiatan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($galeri as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $row->nama_kegiatan }}
                                                    @if ($row->keterangan)
                                                        <br><small class="text-muted">{{ Str::limit($row->keterangan, 40) }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($row->kegiatan)
                                                        <span class="badge badge-primary">
                                                            {{ $row->kegiatan->judul }}
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">Tanpa Label</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $row->tanggal ? \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') : '-' }}
                                                </td>
                                                <td>
                                                    <img src="{{ asset("storage/" . $row->image) }}" alt="Foto Galeri" width="100" height="100" style="border-radius: 10%; object-fit: cover; cursor: pointer;" data-toggle="modal" data-target="#viewModal{{ $row->id }}">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $row->id }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </button>
                                                        <button type="button" data-toggle="modal" data-target="#deleteModal{{ $row->id }}" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </td>

                                                {{-- Modal View Foto --}}
                                                <div class="modal fade" id="viewModal{{ $row->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">{{ $row->nama_kegiatan }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal">
                                                                    <span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset("storage/" . $row->image) }}" class="img-fluid" alt="{{ $row->nama_kegiatan }}">
                                                                @if ($row->keterangan)
                                                                    <p class="mt-3 text-muted">{{ $row->keterangan }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Modal Konfirmasi Hapus --}}
                                                <div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $row->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $row->id }}">
                                                                    Konfirmasi Hapus
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus foto "{{ $row->nama_kegiatan }}"?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    Batal
                                                                </button>
                                                                <form action="{{ route("galeri.destroy", $row->id) }}" method="POST">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Ya, Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End Modal Konfirmasi Hapus --}}

                                                {{-- Modal Edit Galeri --}}
                                                <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Galeri Desa</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route("galeri.update", $row->id) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method("PUT")
                                                                    <div class="form-group">
                                                                        <label for="nama_edit{{ $row->id }}">Nama Kegiatan <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" id="nama_edit{{ $row->id }}" name="nama_kegiatan" value="{{ $row->nama_kegiatan }}" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="kegiatan_desa_id_edit{{ $row->id }}">Label Kegiatan <span class="text-danger">*</span></label>
                                                                        <select class="form-control" id="kegiatan_desa_id_edit{{ $row->id }}" name="kegiatan_desa_id" required>
                                                                            <option value="">-- Pilih Kegiatan --</option>
                                                                            @foreach ($kegiatanList as $kegiatan)
                                                                                <option value="{{ $kegiatan->id }}" {{ $row->kegiatan_desa_id == $kegiatan->id ? "selected" : "" }}>
                                                                                    {{ $kegiatan->judul }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="tanggal_edit{{ $row->id }}">Tanggal Foto</label>
                                                                                <input type="date" class="form-control" id="tanggal_edit{{ $row->id }}" name="tanggal" value="{{ $row->tanggal }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="image_edit{{ $row->id }}">Foto Kegiatan</label>
                                                                                <input type="file" class="form-control galeri-image" id="image_edit{{ $row->id }}" name="image" accept="image/png, image/jpeg">
                                                                                @if ($row->image)
                                                                                    <img src="{{ asset("storage/" . $row->image) }}" alt="Foto" class="img-thumbnail mt-2" width="100">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="keterangan_edit{{ $row->id }}">Keterangan</label>
                                                                        <textarea class="form-control" id="keterangan_edit{{ $row->id }}" name="keterangan" rows="2">{{ $row->keterangan }}</textarea>
                                                                    </div>

                                                                    <button type="submit" class="btn btn-primary">
                                                                        <i class="fas fa-save"></i> Simpan Perubahan
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End Modal Edit Galeri --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Belum ada data galeri</td>
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

    {{-- Script untuk Toggle Form --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pilihExisting = document.getElementById('pilihExisting');
            const buatBaru = document.getElementById('buatBaru');
            const existingGroup = document.getElementById('existingKegiatanGroup');
            const newGroup = document.getElementById('newKegiatanGroup');
            const selectKegiatan = document.getElementById('kegiatan_desa_id');
            const judulBaru = document.getElementById('judul_kegiatan_baru');

            // Toggle form berdasarkan pilihan radio
            pilihExisting.addEventListener('change', function() {
                if (this.checked) {
                    existingGroup.style.display = 'block';
                    newGroup.style.display = 'none';
                    selectKegiatan.required = true;
                    judulBaru.required = false;
                }
            });

            buatBaru.addEventListener('change', function() {
                if (this.checked) {
                    existingGroup.style.display = 'none';
                    newGroup.style.display = 'block';
                    selectKegiatan.required = false;
                    judulBaru.required = true;
                    selectKegiatan.value = ''; // Reset select
                }
            });

            // Preview image
            document.querySelectorAll('.galeri-image').forEach(input => {
                input.addEventListener('change', function() {
                    const targetId = this.getAttribute('data-target');
                    const preview = document.getElementById(targetId);
                    const file = this.files[0];

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    }
                });
            });
        });
    </script>
@endsection
