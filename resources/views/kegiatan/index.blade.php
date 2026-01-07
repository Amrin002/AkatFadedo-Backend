@extends("template.main")
@section("content")
				<div class="container">
								<div class="page-inner">
												<div class="row">
																<div class="col">
																				<h3>{{ $title }}</h3>
																				<div class="card">
																								<div class="card-header">
																												<h5>{{ $halaman }}</h5>
																								</div>
																								<div class="card-body">
																												<button class="btn btn-success mb-3" data-toggle="modal" data-target="#tambahKegiatanModal">
																																<i class="fas fa-plus-circle"></i> Tambah Kegiatan
																												</button>

																												{{-- Modal Tambah Kegiatan --}}
																												<div class="modal fade" id="tambahKegiatanModal" tabindex="-1" role="dialog"
																																aria-labelledby="tambahKegiatanModalTitle" aria-hidden="true">
																																<div class="modal-dialog modal-dialog-centered" role="document">
																																				<div class="modal-content">
																																								<div class="modal-header">
																																												<h5 class="modal-title" id="tambahKegiatanModalTitle">Tambah Kegiatan</h5>
																																												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																																																<span aria-hidden="true">&times;</span>
																																												</button>
																																								</div>
																																								<div class="modal-body">
																																												<form action="{{ route("kegiatan.store") }}" method="POST">
																																																@csrf
																																																<div class="form-group">
																																																				<label for="judul">Judul Kegiatan <span
																																																												class="text-danger">*</span></label>
																																																				<input type="text" class="form-control" id="judul" name="judul"
																																																								value="{{ old("judul") }}" required>
																																																</div>
																																																<div class="form-group">
																																																				<label for="deskripsi">Deskripsi</label>
																																																				<textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"
																																																				    placeholder="Deskripsi kegiatan (opsional)">{{ old("deskripsi") }}</textarea>
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
																												{{-- End Modal Tambah Kegiatan --}}

																												{{-- Tabel Data --}}
																												<div class="table-responsive">
																																<table class="table table-striped">
																																				<thead>
																																								<tr>
																																												<th scope="col">No</th>
																																												<th scope="col">Judul Kegiatan</th>
																																												<th scope="col">Deskripsi</th>
																																												<th scope="col">Jumlah Foto</th>
																																												<th scope="col">Action</th>
																																								</tr>
																																				</thead>
																																				<tbody>
																																								@forelse ($kegiatan as $row)
																																												<tr>
																																																<td>{{ $loop->iteration }}</td>
																																																<td>{{ $row->judul }}</td>
																																																<td>{{ Str::limit($row->deskripsi, 50) }}</td>
																																																<td>
																																																				<span class="badge badge-info">
																																																								<i class="fas fa-images"></i> {{ $row->fotos_count ?? 0 }} foto
																																																				</span>
																																																</td>
																																																<td>
																																																				<div class="d-flex align-items-center gap-2">
																																																								<a href="{{ route("kegiatan.show", $row->id) }}"
																																																												class="btn btn-info btn-sm">
																																																												<i class="fas fa-eye"></i> Detail
																																																								</a>
																																																								<button type="button" class="btn btn-warning btn-sm"
																																																												data-toggle="modal"
																																																												data-target="#editModal{{ $row->id }}">
																																																												<i class="fas fa-edit"></i> Edit
																																																								</button>
																																																								<button type="button" data-toggle="modal"
																																																												data-target="#deleteModal{{ $row->id }}"
																																																												class="btn btn-danger btn-sm">
																																																												<i class="fas fa-trash"></i> Hapus
																																																								</button>
																																																				</div>
																																																</td>

																																																{{-- Modal Konfirmasi Hapus --}}
																																																<div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1"
																																																				aria-labelledby="deleteModalLabel{{ $row->id }}"
																																																				aria-hidden="true">
																																																				<div class="modal-dialog">
																																																								<div class="modal-content">
																																																												<div class="modal-header">
																																																																<h5 class="modal-title"
																																																																				id="deleteModalLabel{{ $row->id }}">
																																																																				Konfirmasi Hapus
																																																																</h5>
																																																																<button type="button" class="close" data-dismiss="modal"
																																																																				aria-label="Close">
																																																																				<span aria-hidden="true">&times;</span>
																																																																</button>
																																																												</div>
																																																												<div class="modal-body">
																																																																Apakah Anda yakin ingin menghapus Kegiatan
																																																																"{{ $row->judul }}"?
																																																																@if (($row->fotos_count ?? 0) > 0)
																																																																				<div class="alert alert-warning mt-2">
																																																																								<i class="fas fa-exclamation-triangle"></i>
																																																																								Kegiatan ini memiliki {{ $row->fotos_count }} foto.
																																																																								Hapus foto terlebih dahulu!
																																																																				</div>
																																																																@endif
																																																												</div>
																																																												<div class="modal-footer">
																																																																<button type="button" class="btn btn-secondary"
																																																																				data-dismiss="modal">
																																																																				Batal
																																																																</button>
																																																																<form action="{{ route("kegiatan.destroy", $row->id) }}"
																																																																				method="POST">
																																																																				@csrf
																																																																				@method("DELETE")
																																																																				<button type="submit" class="btn btn-danger"
																																																																								{{ ($row->fotos_count ?? 0) > 0 ? "disabled" : "" }}>
																																																																								Ya, Hapus
																																																																				</button>
																																																																</form>
																																																												</div>
																																																								</div>
																																																				</div>
																																																</div>
																																																{{-- End Modal Konfirmasi Hapus --}}

																																																{{-- Modal Edit Kegiatan --}}
																																																<div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1"
																																																				role="dialog">
																																																				<div class="modal-dialog modal-dialog-centered" role="document">
																																																								<div class="modal-content">
																																																												<div class="modal-header">
																																																																<h5 class="modal-title">Edit Kegiatan Desa</h5>
																																																																<button type="button" class="close"
																																																																				data-dismiss="modal" aria-label="Close">
																																																																				<span aria-hidden="true">&times;</span>
																																																																</button>
																																																												</div>
																																																												<div class="modal-body">
																																																																<form action="{{ route("kegiatan.update", $row->id) }}"
																																																																				method="POST">
																																																																				@csrf
																																																																				@method("PUT")
																																																																				<div class="form-group">
																																																																								<label for="judul_edit{{ $row->id }}">Judul
																																																																												Kegiatan <span
																																																																																class="text-danger">*</span></label>
																																																																								<input type="text" class="form-control"
																																																																												id="judul_edit{{ $row->id }}"
																																																																												name="judul" value="{{ $row->judul }}"
																																																																												required>
																																																																				</div>
																																																																				<div class="form-group">
																																																																								<label
																																																																												for="deskripsi_edit{{ $row->id }}">Deskripsi</label>
																																																																								<textarea class="form-control" id="deskripsi_edit{{ $row->id }}" name="deskripsi" rows="4">{{ $row->deskripsi }}</textarea>
																																																																				</div>
																																																																				<button type="submit" class="btn btn-primary">
																																																																								<i class="fas fa-save"></i> Simpan Perubahan
																																																																				</button>
																																																																</form>
																																																												</div>
																																																								</div>
																																																				</div>
																																																</div>
																																																{{-- End Modal Edit Kegiatan --}}
																																												</tr>
																																								@empty
																																												<tr>
																																																<td colspan="5" class="text-center">Belum ada data kegiatan</td>
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
