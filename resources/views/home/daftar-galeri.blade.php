@extends("layouts.main")

@section("content")
				<div class="main-wrapper">
								<div class="content-area">
												<main class="container py-5 galeri-container" style="margin-top:70px; max-width:1400px;">
																{{-- Judul Halaman --}}
																<h2 class="mb-5 text-center fw-bolder text-dark" style="font-size:2.2rem;">
																				Galeri Desa Akat Fadedo
																</h2>

																{{-- Link Kembali ke Home --}}
																<div class="mb-4">
																				<a href="{{ route("home") }}" class="text-decoration-none text-info fw-semibold link-home">
																								<i class="fas fa-home me-1"></i> Kembali ke Home
																				</a>
																</div>

																{{-- Galeri Berdasarkan Kegiatan (Group) --}}
																@php
																				$kegiatanGroups = $galeri->groupBy("kegiatan_desa_id");
																@endphp

																@if ($kegiatanGroups->isEmpty())
																				<div class="text-center alert alert-info">Belum ada galeri tersedia.</div>
																@else
																				@foreach ($kegiatanGroups as $kegiatanId => $items)
																								@php
																												$kegiatan = $items->first()->kegiatan;
																												$groupId = $kegiatanId ? "kegiatan-" . $kegiatanId : "tanpa-label";
																								@endphp

																								<div class="mb-5 galeri-group reveal" id="{{ $groupId }}">
																												{{-- Header Group --}}
																												<div class="p-3 mb-3 card shadow-sm border-start border-primary border-4">
																																<div class="row align-items-center">
																																				<div class="col-md-8">
																																								@if ($kegiatan)
																																												<h5 class="mb-1 fw-bold text-dark">
																																																<i class="fas fa-folder-open text-primary me-2"></i>
																																																{{ $kegiatan->judul }}
																																												</h5>
																																												@if ($kegiatan->deskripsi)
																																																<p class="mb-0 text-muted small">
																																																				{{ $kegiatan->deskripsi }}
																																																</p>
																																												@endif
																																								@else
																																												<h5 class="mb-1 fw-bold text-dark">
																																																<i class="fas fa-images text-secondary me-2"></i>
																																																Galeri Tanpa Label
																																												</h5>
																																												<p class="mb-0 text-muted small">Foto-foto yang belum dikategorikan</p>
																																								@endif
																																				</div>
																																				<div class="col-md-4 text-md-end">
																																								<span class="badge bg-primary px-3 py-2" style="font-size: 0.875rem;">
																																												<i class="fas fa-images me-1"></i>
																																												{{ $items->count() }} Foto
																																								</span>
																																				</div>
																																</div>
																												</div>

																												{{-- Grid Foto dalam Group --}}
																												<div class="row g-3 mb-4">
																																@foreach ($items->take(4) as $index => $item)
																																				<div class="col-lg-3 col-md-4 col-sm-6">
																																								<div class="overflow-hidden border-0 shadow-sm card galeri-card h-100 rounded-3">
																																												<div class="galeri-img-wrapper">
																																																<img src="{{ asset("storage/" . $item->image) }}"
																																																				alt="{{ $item->nama_kegiatan }}"
																																																				class="card-img-top galeri-img img-gallery"
																																																				data-group="{{ $groupId }}" data-index="{{ $index }}"
																																																				data-img-src="{{ asset("storage/" . $item->image) }}"
																																																				data-title="{{ $item->nama_kegiatan }}"
																																																				data-kegiatan="{{ $kegiatan ? $kegiatan->judul : "Tanpa Label" }}"
																																																				data-tanggal="{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format("d F Y") : "" }}"
																																																				data-keterangan="{{ $item->keterangan ?? "" }}">
																																												</div>
																																												<div class="p-2 text-center bg-white">
																																																<p class="mb-0 small fw-semibold text-dark">
																																																				{{ Str::limit($item->nama_kegiatan, 40) }}
																																																</p>
																																												</div>
																																								</div>
																																				</div>
																																@endforeach
																												</div>
																												@if ($items->count() > 4)
																																<div class="text-center mt-3">
																																				<a href="{{ route("galeri.kegiatan", $kegiatanId) }}"
																																								class="btn btn-outline-primary btn-sm">
																																								Lihat Semua Foto
																																				</a>
																																</div>
																												@endif

																												<hr class="my-4">
																								</div>
																				@endforeach
																@endif

																{{-- Pagination --}}
																@if ($galeri->hasPages())
																				<div class="mt-5 d-flex justify-content-center">
																								{{ $galeri->appends(request()->query())->links() }}
																				</div>
																@endif
												</main>
								</div>
				</div>

				<!-- Modal Galeri -->
				<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-xl">
												<div class="overflow-hidden text-white border-0 shadow-lg modal-content bg-dark rounded-4">
																<div class="p-0 modal-body position-relative">
																				<!-- Gambar -->
																				<img id="modalImage" src="" alt="Gambar Galeri" class="img-fluid w-100 d-block">

																				<!-- Caption -->
																				<div class="bottom-0 p-4 bg-opacity-75 bg-dark position-absolute start-0 w-100">
																								<p class="mb-1 text-center small text-white-50" id="modalKegiatan"></p>
																								<h5 id="modalTitle" class="mb-2 text-center fw-semibold"></h5>
																								<p class="mb-1 text-center small text-white-50" id="modalTanggal">
																												<i class="far fa-calendar-alt me-1"></i>
																												<span id="modalTanggalText"></span>
																								</p>
																								<p class="mb-0 text-center small text-white" id="modalKeterangan"></p>
																				</div>

																				<!-- Tombol Tutup -->
																				<button type="button" class="top-0 m-3 btn-close btn-close-white position-absolute end-0"
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

{{-- styles Galeri --}}
@push("styles")
				<style>
								html,
								body {
												height: 100%;
								}

								.main-wrapper {
												min-height: 95%;
												display: flex;
												flex-direction: column;
								}

								.content-area {
												flex: 1;
								}

								.galeri-container {
												min-height: 70vh;
								}

								/* Galeri Group */
								.galeri-group {
												background: #f8f9fa;
												padding: 2rem;
												border-radius: 12px;
												margin-bottom: 2rem;
								}

								/* Card galeri */
								.galeri-card {
												transition: transform 0.3s ease, box-shadow 0.3s ease;
												cursor: pointer;
												background: white;
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
												height: 200px;
												width: 100%;
												object-fit: cover;
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

								/* Modal caption improvements */
								#modalKeterangan {
												font-style: italic;
												line-height: 1.5;
								}

								#modalTanggal {
												display: none;
												/* Hidden by default, shown via JS if data exists */
								}

								/* Animasi reveal */
								.reveal {
												opacity: 0;
												transform: translateY(30px);
												transition: all 0.8s ease;
								}

								.reveal.reveal-visible {
												opacity: 1;
												transform: none;
								}

								/* Link home */
								.link-home {
												transition: all 0.3s ease;
												display: inline-block;
								}

								.link-home:hover {
												transform: translateX(5px);
												color: #0056b3 !important;
								}

								/* Border accent */
								.border-primary {
												border-width: 4px !important;
								}

								/* Responsive adjustments */
								@media (max-width: 768px) {
												.galeri-group {
																padding: 1rem;
												}

												.galeri-img {
																height: 180px;
												}
								}
				</style>
@endpush

{{-- script Modal Galeri --}}
@push("scripts")
				<script>
								document.addEventListener('DOMContentLoaded', function() {
												// Modal Gallery functionality
												const galleryItems = document.querySelectorAll('.img-gallery');
												let currentGroup = 'all';
												let currentIndex = 0;

												const modalImage = document.getElementById('modalImage');
												const modalTitle = document.getElementById('modalTitle');
												const modalKegiatan = document.getElementById('modalKegiatan');
												const modalTanggal = document.getElementById('modalTanggal');
												const modalTanggalText = document.getElementById('modalTanggalText');
												const modalKeterangan = document.getElementById('modalKeterangan');
												const galleryModal = new bootstrap.Modal(document.getElementById('galleryModal'));

												function getGroupItems(group) {
																return Array.from(galleryItems).filter(item => {
																				return item.dataset.group === group;
																});
												}

												function showImage(index, group) {
																const groupItems = getGroupItems(group);

																if (groupItems.length === 0) return;

																// Ensure index is within bounds
																index = (index + groupItems.length) % groupItems.length;

																const img = groupItems[index];

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
																currentGroup = group;
																galleryModal.show();
												}

												// Click handler untuk setiap gambar
												galleryItems.forEach((item, globalIndex) => {
																item.addEventListener('click', function() {
																				const group = this.dataset.group;
																				const groupItems = getGroupItems(group);
																				const indexInGroup = groupItems.indexOf(this);
																				showImage(indexInGroup, group);
																});
												});

												// Navigation buttons
												document.getElementById('prevBtn').addEventListener('click', () => {
																showImage(currentIndex - 1, currentGroup);
												});

												document.getElementById('nextBtn').addEventListener('click', () => {
																showImage(currentIndex + 1, currentGroup);
												});

												// Keyboard navigation
												document.addEventListener('keydown', function(e) {
																if (galleryModal._isShown) {
																				if (e.key === 'ArrowLeft') {
																								showImage(currentIndex - 1, currentGroup);
																				} else if (e.key === 'ArrowRight') {
																								showImage(currentIndex + 1, currentGroup);
																				} else if (e.key === 'Escape') {
																								galleryModal.hide();
																				}
																}
												});

												// Animasi scroll reveal
												const revealElements = document.querySelectorAll('.reveal');
												const observer = new IntersectionObserver(entries => {
																entries.forEach(entry => {
																				if (entry.isIntersecting) {
																								entry.target.classList.add('reveal-visible');
																								observer.unobserve(entry.target);
																				}
																});
												}, {
																threshold: 0.1
												});
												revealElements.forEach(el => observer.observe(el));
								});
				</script>
@endpush
