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
																																												<th>Tanggal</th>
																																												<td>:
																																																{{ $kegiatan->tanggal ? \Carbon\Carbon::parse($kegiatan->tanggal)->format("d F Y") : "-" }}
																																												</td>
																																								</tr>
																																								<tr>
																																												<th>Deskripsi</th>
																																												<td>: {{ $kegiatan->deskripsi ?: "-" }}</td>
																																								</tr>
																																								<tr>
																																												<th>Jumlah Foto</th>
																																												<td>: {{ $kegiatan->fotos->count() }} foto</td>
																																								</tr>
																																				</table>
																																</div>
																												</div>
																								</div>
																				</div>

																				{{-- Card Grid Foto --}}
																				<div class="card">
																								<div class="card-header">
																												<h5>Galeri Foto Kegiatan</h5>
																								</div>
																								<div class="card-body">
																												@if ($kegiatan->fotos->count() > 0)
																																<div class="row">
																																				@foreach ($kegiatan->fotos as $foto)
																																								<div class="col-md-3 col-sm-6 mb-4">
																																												<div class="card h-100">
																																																<img src="{{ asset("storage/" . $foto->image) }}" class="card-img-top"
																																																				alt="{{ $foto->nama_kegiatan }}"
																																																				style="height: 200px; object-fit: cover; cursor: pointer;"
																																																				data-toggle="modal" data-target="#fotoModal{{ $foto->id }}">
																																																<div class="card-body p-2">
																																																				<p class="card-text small mb-0">{{ $foto->nama_kegiatan }}</p>
																																																</div>
																																												</div>

																																												{{-- Modal untuk melihat foto full size --}}
																																												<div class="modal fade" id="fotoModal{{ $foto->id }}" tabindex="-1"
																																																role="dialog">
																																																<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
																																																				<div class="modal-content">
																																																								<div class="modal-header">
																																																												<h5 class="modal-title">{{ $foto->nama_kegiatan }}</h5>
																																																												<button type="button" class="close" data-dismiss="modal">
																																																																<span>&times;</span>
																																																												</button>
																																																								</div>
																																																								<div class="modal-body text-center">
																																																												<img src="{{ asset("storage/" . $foto->image) }}"
																																																																class="img-fluid" alt="{{ $foto->nama_kegiatan }}">
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
																																				<small>Anda dapat menambahkan foto melalui halaman Galeri Desa dan pilih kegiatan ini
																																								sebagai label.</small>
																																</div>
																												@endif
																								</div>
																				</div>
																</div>
												</div>
								</div>
				</div>
@endsection
