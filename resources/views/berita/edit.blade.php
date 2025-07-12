@extends('template.main')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Edit Berita</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5>Form Edit Berita</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label for="judul">Judul <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" 
                                           name="judul" 
                                           value="{{ old('judul', $berita->judul) }}" 
                                           placeholder="Masukkan judul berita"
                                           required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="konten">Konten <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('konten') is-invalid @enderror" 
                                              id="konten" 
                                              name="konten">{{ old('konten', $berita->konten) }}</textarea>
                                    @error('konten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    
                                    @if($berita->gambar)
                                        <div class="mb-3">
                                            <p>Gambar saat ini:</p>
                                            <img src="{{ asset('storage/' . $berita->gambar) }}" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 300px;">
                                        </div>
                                    @endif
                                    
                                    <input type="file" 
                                           class="form-control @error('gambar') is-invalid @enderror" 
                                           id="gambar" 
                                           name="gambar"
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar. Format: JPEG, PNG, JPG (Max: 2MB)</small>
                                    
                                    <!-- Preview New Image -->
                                    <div class="mt-3">
                                        <img id="preview" 
                                             src="#" 
                                             alt="Preview Gambar Baru" 
                                             class="img-thumbnail" 
                                             style="max-width: 300px; display: none;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Update
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