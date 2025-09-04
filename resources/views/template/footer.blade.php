<footer class="footer">
    <div class="container-fluid d-flex justify-content-center">
        {{-- <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="http://www.themekita.com">
                        ThemeKita
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Help </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Licenses </a>
                </li>
            </ul>
        </nav> --}}
        <div class="copyright">
            {{ now()->year }}, made by
            <a href="#">Local Class Technology</a>
        </div>
        {{-- <div>
            Distributed by
            <a target="_blank" href="#">Local Class Technology</a>.
        </div> --}}
    </div>
</footer>
{{-- End main-panel --}}
</div>
{{-- End wrapper --}}
</div>

</div>
<!-- Core JS Files -->
<script src="{{ asset ('admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset ('admin/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset ('admin/assets/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery Scrollbar -->
<script src="{{ asset ('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset ('admin/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset ('admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset ('admin/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset ('admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>

<!-- Bootstrap Notify -->
<script src="{{ asset ('admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset ('admin/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset ('admin/assets/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Sweet Alert -->
<script src="{{ asset ('admin/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

<!-- Kaiadmin JS -->
<script src="{{ asset ('admin/assets/js/kaiadmin.min.js') }}"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Sweet Alert 2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });
</script>

<script>
    $(document).ready(function() {
        // Initialize DataTables jika ada
        if ($.fn.DataTable && $("#data-penduduk").length) {
            $("#data-penduduk").DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                }
            });
        }

        // Initialize Datepicker
        if ($.fn.datepicker && $('#datepicker input').length) {
            $('#datepicker input').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });
        }
    });
</script>

<script>
    // Jika ada error, modal akan otomatis muncul
    @if ($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('errorModal'), {});
        myModal.show();
    @endif
</script>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('photoPreview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pilih semua input file dengan name image
        document.querySelectorAll('input[type="file"][name="image"]').forEach(input => {
            input.addEventListener("change", function(event) {
                var file = event.target.files[0];

                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // Ambil elemen preview yang sesuai dengan input
                        var preview = document.querySelector(
                            `#${event.target.dataset.target}`);
                        if (preview) {
                            preview.src = e.target.result;
                            preview.style.display = "block";
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>

{{-- Script Sturuktur Desa --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("input[type='file'].struktur-image").forEach(input => {
            input.addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        // Membuat canvas untuk cropping
                        const canvas = document.createElement("canvas");
                        const ctx = canvas.getContext("2d");

                        // Set ukuran crop (600x600)
                        canvas.width = 600;
                        canvas.height = 600;

                        // Ambil area tengah gambar
                        const minSize = Math.min(img.width, img.height);
                        const sx = (img.width - minSize) / 2;
                        const sy = (img.height - minSize) / 2;

                        ctx.drawImage(img, sx, sy, minSize, minSize, 0, 0, 600, 600);

                        // Konversi ke Blob (JPEG)
                        canvas.toBlob(function(blob) {
                            const croppedFile = new File([blob],
                                "cropped.jpg", {
                                    type: "image/jpeg"
                                });

                            // Update input file dengan gambar yang sudah dipotong
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(croppedFile);
                            event.target.files = dataTransfer.files;

                            // Menampilkan preview
                            const previewId = event.target.getAttribute(
                                "data-target");
                            const preview = document.getElementById(previewId);
                            if (preview) {
                                preview.src = URL.createObjectURL(blob);
                                preview.style.display = "block";
                            }
                        }, "image/jpeg");
                    };
                };
                reader.readAsDataURL(file);
            });
        });
    });
</script>

{{-- Script Galeri Desa --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll("input[type='file'].galeri-image").forEach(input => {
            input.addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        // Membuat canvas untuk cropping
                        const canvas = document.createElement("canvas");
                        const ctx = canvas.getContext("2d");

                        // Set ukuran crop (600x600)
                        canvas.width = 600;
                        canvas.height = 600;

                        // Ambil area tengah gambar
                        const minSize = Math.min(img.width, img.height);
                        const sx = (img.width - minSize) / 2;
                        const sy = (img.height - minSize) / 2;

                        ctx.drawImage(img, sx, sy, minSize, minSize, 0, 0, 600, 600);

                        // Konversi ke Blob (JPEG)
                        canvas.toBlob(function(blob) {
                            const croppedFile = new File([blob],
                                "cropped.jpg", {
                                    type: "image/jpeg"
                                });

                            // Update input file dengan gambar yang sudah dipotong
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(croppedFile);
                            event.target.files = dataTransfer.files;

                            // Menampilkan preview
                            const previewId = event.target.getAttribute(
                                "data-target");
                            const preview = document.getElementById(previewId);
                            if (preview) {
                                preview.src = URL.createObjectURL(blob);
                                preview.style.display = "block";
                            }
                        }, "image/jpeg");
                    };
                };
                reader.readAsDataURL(file);
            });
        });
    });
</script>

{{-- Validasi Surat --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.status-select').forEach(function(select) {
            const id = select.getAttribute('data-id');
            const noSuratInput = document.getElementById('no_surat' + id);
            const form = document.getElementById('editForm' + id);

            // Saat submit, cek status
            form.addEventListener('submit', function(e) {
                if (select.value === 'Approve' && !noSuratInput.value.trim()) {
                    e.preventDefault();
                    alert('Nomor surat wajib diisi jika status disetujui (Approve).');
                    noSuratInput.focus();
                }
            });

            // Optional: auto-enable required jika "Approve"
            select.addEventListener('change', function() {
                if (select.value === 'Approve') {
                    noSuratInput.setAttribute('required', 'required');
                } else {
                    noSuratInput.removeAttribute('required');
                }
            });
        });
    });
</script>

{{-- Notifikasi dan Error Handling --}}
@if ($errors->has('nik'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'NIK Tidak Ditemukan',
            text: '{{ $errors->first('nik') }}',
        });
    </script>
@endif

{{-- validasi surat --}}
@if ($errors->has('no_surat_required'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            text: '{{ $errors->first('no_surat_required') }}',
        });
    </script>
@endif

@if ($errors->has('export_error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Export Gagal',
            text: '{{ $errors->first('export_error') }}',
        });
    </script>
@endif

{{-- Error Penduduk --}}
@if (session('import_gagal'))
    <script>
        Swal.fire({
            title: 'Sebagian Gagal!',
            html: "{{ collect(session('import_gagal'))->map(function ($g) {
                    return '<b>NIK:</b> ' . $g['nik'] . ' — ' . $g['alasan'] . '<br>';
                })->implode('') }}",
            icon: 'warning',
            width: 600,
            confirmButtonText: 'Oke',
        });
    </script>
@endif

@if (session('success'))
    <script>
        Swal.fire({
            title: 'Sukses!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Oke'
        });
    </script>
@endif

{{-- Error Input File --}}
@if ($errors->any())
    <script>
        Swal.fire({
            title: 'Gagal!',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            icon: 'error',
            confirmButtonText: 'Oke'
        });
    </script>
@elseif (session('error'))
    <script>
        Swal.fire({
            title: 'Gagal!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'Oke'
        });
    </script>
@endif

{{-- Data Tables - Updated --}}
<script>
    $(document).ready(function() {
        // Initialize semua tabel dengan class 'table' sebagai DataTable
        if ($.fn.DataTable) {
            $('.table').each(function() {
                if (!$.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable({
                        responsive: true,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                        }
                    });
                }
            });
        }
    });
</script>

{{-- Yield untuk script tambahan dari halaman child --}}
@yield('scripts')

</body>

</html>
