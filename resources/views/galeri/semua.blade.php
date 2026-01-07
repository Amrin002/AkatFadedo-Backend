@extends("layouts.main")

@section("content")
				<div class="container py-5" style="margin-top:70px; max-width:1200px;">
								@php
												$kegiatan = $galeri->first()->kegiatan ?? null;
								@endphp

								{{-- Header: Judul & Deskripsi Kegiatan --}}
								<div class="mb-4">
												{{-- Back Button --}}
												<a href="{{ route("home.daftar-galeri") }}" class="btn btn-outline-secondary btn-sm mb-3">
																<i class="fas fa-arrow-left me-1"></i> Kembali ke Galeri
												</a>

												<div class="card border-0 shadow-sm">
																<div class="card-body p-4">
																				<div class="d-flex align-items-center justify-content-between">
																								<div>
																												<h3 class="fw-bold mb-2">
																																<i class="fas fa-folder-open text-primary me-2"></i>
																																{{ $kegiatan->judul ?? "Galeri Kegiatan" }}
																												</h3>
																												@if ($kegiatan && $kegiatan->deskripsi)
																																<p class="text-muted mb-0">
																																				{{ $kegiatan->deskripsi }}
																																</p>
																												@endif
																								</div>
																								<div class="text-end">
																												<span class="badge bg-primary px-3 py-2" style="font-size: 0.9rem;">
																																<i class="fas fa-images me-1"></i>
																																{{ $galeri->total() }} Foto
																												</span>
																								</div>
																				</div>
																</div>
												</div>
								</div>

								{{-- Grid Galeri --}}
								<div class="row g-3">
												@forelse ($galeri as $index => $item)
																<div class="col-lg-3 col-md-4 col-sm-6">
																				<div class="card shadow-sm h-100 border-0 galeri-card">
																								<div class="galeri-img-wrapper">
																												<img src="{{ asset("storage/" . $item->image) }}" alt="{{ $item->nama_kegiatan }}"
																																class="card-img-top galeri-img img-gallery"
																																style="height:220px; object-fit:cover; cursor:pointer;" data-index="{{ $index }}"
																																data-img-src="{{ asset("storage/" . $item->image) }}"
																																data-title="{{ $item->nama_kegiatan }}"
																																data-kegiatan="{{ $kegiatan ? $kegiatan->judul : "Tanpa Label" }}"
																																data-tanggal="{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format("d F Y") : "" }}"
																																data-keterangan="{{ $item->keterangan ?? "" }}">
																								</div>
																								{{-- Nama Foto --}}
																								@if ($item->nama_kegiatan)
																												<div class="card-body py-2 text-center">
																																<p class="mb-0 small fw-semibold">
																																				{{ Str::limit($item->nama_kegiatan, 40) }}
																																</p>
																																@if ($item->tanggal)
																																				<p class="mb-0 text-muted" style="font-size: 0.75rem;">
																																								<i class="far fa-calendar-alt me-1"></i>
																																								{{ \Carbon\Carbon::parse($item->tanggal)->format("d M Y") }}
																																				</p>
																																@endif
																												</div>
																								@endif
																				</div>
																</div>
												@empty
																<div class="col-12">
																				<div class="alert alert-info text-center">
																								<i class="fas fa-info-circle me-2"></i>
																								Belum ada foto untuk kegiatan ini.
																				</div>
																</div>
												@endforelse
								</div>

								{{-- Pagination --}}
								@if ($galeri->hasPages())
												<div class="mt-4 d-flex justify-content-center">
																{{ $galeri->links() }}
												</div>
								@endif
				</div>

				<!-- Modal Galeri -->
				<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-xl">
												<div class="modal-content bg-dark text-white border-0 shadow-lg rounded-4 overflow-hidden">
																<div class="modal-body p-0 position-relative">
																				<!-- Gambar -->
																				<img id="modalImage" src="" alt="Gambar Galeri" class="img-fluid w-100 d-block">

																				<!-- Caption -->
																				<div class="position-absolute bottom-0 start-0 w-100 p-4 bg-dark bg-opacity-75">
																								<p class="small text-white-50 text-center mb-1" id="modalKegiatan"></p>
																								<h5 class="fw-semibold text-center mb-2" id="modalTitle"></h5>
																								<p class="small text-white-50 text-center mb-1" id="modalTanggal">
																												<i class="far fa-calendar-alt me-1"></i>
																												<span id="modalTanggalText"></span>
																								</p>
																								<p class="small text-white text-center mb-0" id="modalKeterangan"></p>
																				</div>

																				<!-- Tombol Tutup -->
																				<button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
																								data-bs-dismiss="modal" aria-label="Close"></button>

																				<!-- Navigasi -->
																				<button class="btn btn-dark btn-lg position-absolute top-50 start-0 translate-middle-y ms-3"
																								id="prevBtn" style="z-index: 10;">
																								<i class="fas fa-chevron-left"></i>
																				</button>
																				<button class="btn btn-dark btn-lg position-absolute top-50 end-0 translate-middle-y me-3"
																								id="nextBtn" style="z-index: 10;">
																								<i class="fas fa-chevron-right"></i>
																				</button>
																</div>
												</div>
								</div>
				</div>
@endsection

@push("styles")
				<style>
								/* Card Galeri */
								.galeri-card {
												transition: transform 0.3s ease, box-shadow 0.3s ease;
												cursor: pointer;
								}

								.galeri-card:hover {
												transform: translateY(-8px);
												box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
								}

								.galeri-img-wrapper {
												overflow: hidden;
												position: relative;
												background: #f0f0f0;
								}

								.galeri-img {
												transition: transform 0.5s ease;
								}

								.galeri-card:hover .galeri-img {
												transform: scale(1.15);
								}

								/* Modal */
								#modalImage {
												max-height: 80vh;
												object-fit: contain;
								}

								#galleryModal .btn {
												opacity: 0.8;
												transition: all 0.3s ease;
												backdrop-filter: blur(10px);
								}

								#galleryModal .btn:hover {
												opacity: 1;
												transform: scale(1.1);
								}

								/* Modal caption */
								#modalKeterangan {
												font-style: italic;
												line-height: 1.5;
								}

								#modalTanggal {
												display: none;
								}

								/* Responsive */
								@media (max-width: 768px) {
												.galeri-img {
																height: 180px !important;
												}
								}
				</style>
@endpush

@push("scripts")
				<script>
								document.addEventListener('DOMContentLoaded', function() {
												const galleryItems = document.querySelectorAll('.img-gallery');
												let currentIndex = 0;

												const modalImage = document.getElementById('modalImage');
												const modalTitle = document.getElementById('modalTitle');
												const modalKegiatan = document.getElementById('modalKegiatan');
												const modalTanggal = document.getElementById('modalTanggal');
												const modalTanggalText = document.getElementById('modalTanggalText');
												const modalKeterangan = document.getElementById('modalKeterangan');
												const galleryModal = new bootstrap.Modal(document.getElementById('galleryModal'));

												function showImage(index) {
																if (galleryItems.length === 0) return;

																// Ensure index is within bounds
																index = (index + galleryItems.length) % galleryItems.length;

																const img = galleryItems[index];

																// Set image and basic info
																modalImage.src = img.dataset.imgSrc;
																modalTitle.textContent = img.dataset.title || 'Galeri';
																modalKegiatan.textContent = img.dataset.kegiatan || '';

																// Set tanggal (show/hide based on data)
																const tanggal = img.dataset.tanggal;
																if (tanggal && tanggal.trim() !== '') {
																				modalTanggalText.textContent = tanggal;
																				modalTanggal.style.display = 'block';
																} else {
																				modalTanggal.style.display = 'none';
																}

																// Set keterangan (show/hide based on data)
																const keterangan = img.dataset.keterangan;
																if (keterangan && keterangan.trim() !== '') {
																				modalKeterangan.textContent = keterangan;
																				modalKeterangan.style.display = 'block';
																} else {
																				modalKeterangan.style.display = 'none';
																}

																currentIndex = index;
																galleryModal.show();
												}

												// Click handler untuk setiap gambar
												galleryItems.forEach((item, index) => {
																item.addEventListener('click', function() {
																				showImage(index);
																});
												});

												// Navigation buttons
												document.getElementById('prevBtn').addEventListener('click', () => {
																showImage(currentIndex - 1);
												});

												document.getElementById('nextBtn').addEventListener('click', () => {
																showImage(currentIndex + 1);
												});

												// Keyboard navigation
												document.addEventListener('keydown', function(e) {
																if (galleryModal._isShown) {
																				if (e.key === 'ArrowLeft') {
																								showImage(currentIndex - 1);
																				} else if (e.key === 'ArrowRight') {
																								showImage(currentIndex + 1);
																				} else if (e.key === 'Escape') {
																								galleryModal.hide();
																				}
																}
												});
								});
				</script>
@endpush
