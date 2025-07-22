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

{{-- Script CKEditor yang bersih untuk halaman berita --}}
@section('scripts')
<script>
(function() {
    'use strict';
    
    console.log('🚀 Loading CKEditor script...');
    
    // Variabel lokal untuk menghindari conflict
    var ckeditorInstance = null;
    var isInitialized = false;
    
    // Fungsi inisialisasi CKEditor
    function setupCKEditor() {
        // Cegah multiple initialization
        if (isInitialized) {
            console.log('⚠️ CKEditor already initialized, skipping...');
            return;
        }
        
        console.log('🎯 Setting up CKEditor...');
        
        // Cek element textarea
        var textarea = document.getElementById('konten');
        if (!textarea) {
            console.error('❌ Textarea with ID "konten" not found!');
            return;
        }
        
        // Cek ClassicEditor
        if (typeof ClassicEditor === 'undefined') {
            console.error('❌ ClassicEditor not available!');
            return;
        }
        
        // Cek apakah sudah ada CKEditor di element ini
        if (textarea.nextElementSibling && textarea.nextElementSibling.classList.contains('ck-editor')) {
            console.log('⚠️ CKEditor already exists on this element');
            return;
        }
        
        isInitialized = true;
        console.log('✅ Starting CKEditor initialization...');
        
        // Konfigurasi CKEditor yang aman
        ClassicEditor
            .create(textarea, {
                toolbar: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    '|',
                    'link',
                    '|',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'blockQuote',
                    '|',
                    'undo',
                    'redo'
                ],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3' }
                    ]
                }
            })
            .then(function(editor) {
                ckeditorInstance = editor;
                textarea.ckeditorInstance = editor;
                
                console.log('🎉 CKEditor successfully loaded!');
                
                // Set initial content jika ada
                var initialContent = textarea.value;
                if (initialContent && initialContent.trim()) {
                    editor.setData(initialContent);
                    console.log('📄 Initial content set');
                }
                
                // Event listener untuk perubahan
                editor.model.document.on('change:data', function() {
                    console.log('📝 Content changed');
                });
                
                return editor;
            })
            .catch(function(error) {
                console.error('❌ CKEditor initialization failed:', error);
                isInitialized = false; // Reset flag jika gagal
            });
    }
    
    // Tunggu DOM ready
    function onDocumentReady() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(setupCKEditor, 1500); // Delay 1.5 detik
            });
        } else {
            setTimeout(setupCKEditor, 1500);
        }
    }
    
    // Setup form validation
    function setupFormValidation() {
        var form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                var content = '';
                
                if (ckeditorInstance) {
                    content = ckeditorInstance.getData();
                } else {
                    content = document.getElementById('konten').value;
                }
                
                if (!content || content.trim() === '' || content.trim() === '<p>&nbsp;</p>') {
                    e.preventDefault();
                    
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Peringatan!',
                            text: 'Konten tidak boleh kosong!',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        alert('Konten tidak boleh kosong!');
                    }
                    
                    return false;
                }
                
                console.log('✅ Form validation passed');
            });
        }
    }
    
    // Setup auto-slug generation (jika ada field judul)
    function setupSlugGeneration() {
        var judulField = document.getElementById('judul');
        var slugField = document.getElementById('slug');
        
        if (judulField && slugField) {
            judulField.addEventListener('input', function() {
                var judul = this.value;
                var slug = judul.toLowerCase()
                              .replace(/[^a-z0-9 -]/g, '')
                              .replace(/\s+/g, '-')
                              .replace(/-+/g, '-')
                              .trim();
                slugField.value = slug;
            });
        }
    }
    
    // Global functions untuk akses dari luar
    window.getCKEditorContent = function() {
        if (ckeditorInstance) {
            return ckeditorInstance.getData();
        }
        var textarea = document.getElementById('konten');
        return textarea ? textarea.value : '';
    };
    
    window.setCKEditorContent = function(content) {
        if (ckeditorInstance) {
            ckeditorInstance.setData(content);
        } else {
            var textarea = document.getElementById('konten');
            if (textarea) {
                textarea.value = content;
            }
        }
    };
    
    // Initialize everything
    onDocumentReady();
    
    // Setup form validation when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setupFormValidation();
            setupSlugGeneration();
        });
    } else {
        setupFormValidation();
        setupSlugGeneration();
    }
    
})();
</script>
@endsection