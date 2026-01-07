@extends("template.main")
@section("content")
				<div class="container">
								<div class="page-inner">
												<div class="row">
																<div class="col">
																				<div class="d-flex justify-content-between align-items-center mb-3">
																								<h3>{{ $title }}</h3>
																								<a href="{{ route("kegiatan.index") }}" class="btn btn-secondary">
																												<i class="fas fa-arrow-left"></i> Kembali
																								</a>
																				</div>

																				{{-- Card Detail Kegiatan --}}
																				<div class="card mb-4">
																								<div class="card-header">
																												<h5>Detail Kegiatan</h5>
																								</div>
																								<div class="card-body">
																												<div class="row">
																																<div class="col-md-12">
																																				<table class="table table-borderless">
																																								<tr>
																																												<th width="200">Judul Kegiatan</th>
																																												<td>: {{ $kegiatan->judul }}</td>
																																								</tr>
																																								<tr>
																																												<th>Deskripsi</th>
																																												<td>: {{ $kegiatan->deskripsi ?: "-" }}</td>
																																								</tr>
																																								<tr>
																																												<th>Jumlah Foto</th>
																																												<td>:
																																																<span class="badge badge-info">
																																																				<i class="fas fa-images"></i> {{ $kegiatan->fotos->count() }} foto
																																																</span>
																																												</td>
																																								</tr>
																																				</table>
																																</div>
																												</div>
																								</div>
																				</div>

																				{{-- Card Grid Foto --}}
																				<div class="card">
																								<div class="card-header d-flex justify-content-between align-items-center">
																												<h5 class="mb-0">Galeri Foto Kegiatan</h5>
																												<a href="{{ route("galeri.index") }}" class="btn btn-sm btn-success">
																																<i class="fas fa-plus"></i> Tambah Foto
																												</a>
																								</div>
																								<div class="card-body">
																												@if ($kegiatan->fotos->count() > 0)
																																<div class="row">
																																				@foreach ($kegiatan->fotos as $foto)
																																								<div class="col-md-3 col-sm-6 mb-4">
																																												<div class="card h-100 shadow-sm">
																																																<img src="{{ asset("storage/" . $foto->image) }}" class="card-img-top"
																																																				alt="{{ $foto->nama_kegiatan }}"
																																																				style="height: 200px; object-fit: cover; cursor: pointer;"
																																																				data-toggle="modal" data-target="#fotoModal{{ $foto->id }}">
																																																<div class="card-body p-2">
																																																				<h6 class="card-title small mb-1">{{ $foto->nama_kegiatan }}</h6>
																																																				@if ($foto->tanggal)
																																																								<p class="card-text small text-muted mb-1">
																																																												<i class="far fa-calendar"></i>
																																																												{{ \Carbon\Carbon::parse($foto->tanggal)->format("d M Y") }}
																																																								</p>
																																																				@endif
																																																				@if ($foto->keterangan)
																																																								<p class="card-text small text-muted mb-0">
																																																												{{ Str::limit($foto->keterangan, 60) }}
																																																								</p>
																																																				@endif
																																																</div>
																																												</div>

																																												{{-- Modal untuk melihat foto full size --}}
																																												<div class="modal fade" id="fotoModal{{ $foto->id }}" tabindex="-1"
																																																role="dialog">
																																																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																																																				<div class="modal-content">
																																																								<div class="modal-header">
																																																												<div>
																																																																<h5 class="modal-title">{{ $foto->nama_kegiatan }}</h5>
																																																																@if ($foto->tanggal)
																																																																				<small class="text-muted">
																																																																								<i class="far fa-calendar"></i>
																																																																								{{ \Carbon\Carbon::parse($foto->tanggal)->format("d F Y") }}
																																																																				</small>
																																																																@endif
																																																												</div>
																																																												<button type="button" class="close" data-dismiss="modal">
																																																																<span>&times;</span>
																																																												</button>
																																																								</div>
																																																								<div class="modal-body text-center">
																																																												<img src="{{ asset("storage/" . $foto->image) }}"
																																																																class="img-fluid rounded" alt="{{ $foto->nama_kegiatan }}">
																																																												@if ($foto->keterangan)
																																																																<div class="mt-3 p-3 bg-light rounded">
																																																																				<p class="mb-0 text-muted">
																																																																								<i class="fas fa-info-circle"></i>
																																																																								{{ $foto->keterangan }}
																																																																				</p>
																																																																</div>
																																																												@endif
																																																								</div>
																																																								<div class="modal-footer">
																																																												<small class="text-muted mr-auto">
																																																																Ditambahkan: {{ $foto->created_at->format("d M Y, H:i") }}
																																																												</small>
																																																												<button type="button" class="btn btn-secondary"
																																																																data-dismiss="modal">
																																																																Tutup
																																																												</button>
																																																								</div>
																																																				</div>
																																																</div>
																																												</div>
																																								</div>
																																				@endforeach
																																</div>
																												@else
																																<div class="alert alert-info text-center">
																																				<i class="fas fa-info-circle"></i> Belum ada foto untuk kegiatan ini.
																																				<br>
																																				<small>Anda dapat menambahkan foto melalui halaman
																																								<a href="{{ route("galeri.index") }}" class="alert-link">Galeri Desa</a>
																																								dan pilih kegiatan "{{ $kegiatan->judul }}" sebagai label.
																																				</small>
																																</div>
																												@endif
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
@endsection
