@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Tambah Berita Baru</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Tambah Berita</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="form-group">
                                    <label for="judul">Judul <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" 
                                           name="judul" 
                                           value="{{ old('judul') }}" 
                                           placeholder="Masukkan judul berita"
                                           required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="konten">Konten<span class="text-danger">*</span></label>
                                    <textarea 
                                    class="form-control @error('konten') is-invalid @enderror" 
                                    id="konten" 
                                    name="konten">{{ old('konten') }}</textarea>
                                    @error('konten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" 
                                           class="form-control @error('gambar') is-invalid @enderror" 
                                           id="gambar" 
                                           name="gambar"
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPEG, PNG, JPG (Max: 2MB)</small>
                                    
                                    <!-- Preview Image -->
                                    <div class="mt-3">
                                        <img id="preview" 
                                             src="#" 
                                             alt="Preview Gambar" 
                                             class="img-thumbnail" 
                                             style="max-width: 300px; display: none;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- script preview image --}}

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }
</script>
@endpush


{{-- script tools konten --}}

@push('scripts')
<!-- Load TinyMCE dari CDN -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>


<script>
    tinymce.init({
        selector: '#konten', // target textarea dengan id konten
        height: 500,
        menubar: 'file edit view insert format tools table help',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
        toolbar: 'undo redo | styles | bold italic underline strikethrough | fontselect fontsizeselect formatselect | ' +
                 'alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist checklist | ' +
                 'forecolor backcolor casechange permanentpen formatpainter removeformat | ' +
                 'pagebreak | charmap emoticons | fullscreen preview save print | ' +
                 'insertfile image media link anchor codesample | ltr rtl',
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function() {
                var file = this.files[0];

                const reader = new FileReader();
                reader.onload = function () {
                    cb(reader.result, { title: file.name });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        }
    });
</script>
@endpush
