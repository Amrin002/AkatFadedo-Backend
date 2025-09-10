@extends('template.main')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col">
                    <h3>Aplikasi Layanan Desa</h3>
                    <div class="card">
                        <div class="card-header">
                            <h5>Data Versi Aplikasi</h5>
                        </div>
                        <div class="card-body">
                            {{-- Alert Success --}}
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- Alert Error --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fas fa-plus-circle"></i> Update Aplikasi Baru
                            </button>

                            {{-- Modal Tambah Version --}}
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Upload Version Baru</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('app-version.store') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="version">Versi Aplikasi *</label>
                                                            <input type="text" class="form-control" id="version"
                                                                name="version" value="{{ old('version') }}"
                                                                placeholder="contoh: 1.3" required>
                                                            <small class="form-text text-muted">Format: 1.3 atau
                                                                1.3.0</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="version_code">Version Code *</label>
                                                            <input type="number" class="form-control" id="version_code"
                                                                name="version_code" placeholder="Contoh: 10300"
                                                                value="{{ old('version_code') }}" required>
                                                            <small class="form-text text-muted">Harus lebih besar dari
                                                                version code sebelumnya</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="minimum_version">Versi Minimum</label>
                                                            <input type="text" class="form-control" id="minimum_version"
                                                                name="minimum_version" value="{{ old('minimum_version') }}"
                                                                placeholder="contoh: 1.1">
                                                            <small class="form-text text-muted">Versi minimum yang
                                                                didukung</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="minimum_version_code">Minimum Version Code</label>
                                                            <input type="number" class="form-control"
                                                                id="minimum_version_code" name="minimum_version_code"
                                                                placeholder="Contoh: 10100"
                                                                value="{{ old('minimum_version_code') }}">
                                                            <small class="form-text text-muted">Harus lebih kecil dari
                                                                version code</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="apk_file">File APK *</label>
                                                    <input type="file" class="form-control-file" id="apk_file"
                                                        name="apk_file" accept=".apk" required>
                                                    <small class="form-text text-muted">File APK maksimal 50MB</small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="platform">Platform *</label>
                                                    <select class="form-control" id="platform" name="platform" required>
                                                        <option value="android"
                                                            {{ old('platform') == 'android' ? 'selected' : '' }}>Android
                                                        </option>
                                                        <option value="ios"
                                                            {{ old('platform') == 'ios' ? 'selected' : '' }}>iOS
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="is_force_update" name="is_force_update" value="1"
                                                            {{ old('is_force_update') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="is_force_update">
                                                            Force Update (Wajib Update)
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="changelog">Changelog</label>
                                                    <textarea class="form-control" id="changelog" name="changelog" rows="4"
                                                        placeholder="- Fitur baru A&#10;- Perbaikan bug B&#10;- Optimasi performa">{{ old('changelog') }}</textarea>
                                                    <small class="form-text text-muted">Pisahkan setiap item dengan
                                                        baris baru</small>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-upload"></i> Upload Version
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal Tambah Version --}}

                            {{-- Tabel Data --}}
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Versi</th>
                                            <th scope="col">Version Code</th>
                                            <th scope="col">Platform</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Force Update</th>
                                            <th scope="col">File Size</th>
                                            <th scope="col">Tanggal Upload</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($versions as $version)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $version->version }}</strong>
                                                    @if ($version->is_active)
                                                        <span class="badge badge-success ml-1">Latest</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <code>{{ $version->version_code }}</code>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge badge-{{ $version->platform == 'android' ? 'primary' : 'secondary' }}">
                                                        {{ ucfirst($version->platform) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($version->is_active)
                                                        <span class="badge badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge badge-secondary">Nonaktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($version->is_force_update)
                                                        <span class="badge badge-danger">Ya</span>
                                                    @else
                                                        <span class="badge badge-info">Tidak</span>
                                                    @endif
                                                </td>
                                                <td>{{ $version->file_size ?? '-' }}</td>
                                                <td>{{ $version->created_at->format('d M Y H:i') }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-1">
                                                        {{-- Button Download --}}
                                                        @if ($version->download_url)
                                                            <a href="{{ $version->full_download_url }}"
                                                                class="btn btn-info btn-sm" target="_blank">
                                                                <i class="fas fa-download"></i>
                                                            </a>
                                                        @endif

                                                        {{-- Button View Detail --}}
                                                        <button type="button" class="btn btn-primary btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#detailModal{{ $version->id }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>

                                                        {{-- Button Edit --}}
                                                        <button type="button" class="btn btn-warning btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#editModal{{ $version->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        {{-- Button Toggle Active --}}
                                                        <form
                                                            action="{{ route('app-version.toggle-active', $version->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="btn btn-{{ $version->is_active ? 'secondary' : 'success' }} btn-sm"
                                                                onclick="return confirm('Yakin ingin {{ $version->is_active ? 'menonaktifkan' : 'mengaktifkan' }} versi ini?')">
                                                                <i
                                                                    class="fas fa-{{ $version->is_active ? 'toggle-off' : 'toggle-on' }}"></i>
                                                            </button>
                                                        </form>

                                                        {{-- Button Delete --}}
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#deleteModal{{ $version->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            {{-- Modal Detail --}}
                                            <div class="modal fade" id="detailModal{{ $version->id }}" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detail Version {{ $version->version }}
                                                                ({{ $version->version_code }})
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong>Versi:</strong> {{ $version->version }}<br>
                                                                    <strong>Version Code:</strong>
                                                                    {{ $version->version_code }}<br>
                                                                    <strong>Platform:</strong>
                                                                    {{ ucfirst($version->platform) }}<br>
                                                                    <strong>Minimum Version:</strong>
                                                                    {{ $version->minimum_version ?? '-' }}<br>
                                                                    <strong>Minimum Version Code:</strong>
                                                                    {{ $version->minimum_version_code ?? '-' }}<br>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong>Status:</strong>
                                                                    {{ $version->is_active ? 'Aktif' : 'Nonaktif' }}<br>
                                                                    <strong>Force Update:</strong>
                                                                    {{ $version->is_force_update ? 'Ya' : 'Tidak' }}<br>
                                                                    <strong>File Size:</strong>
                                                                    {{ $version->file_size ?? '-' }}<br>
                                                                    <strong>Upload:</strong>
                                                                    {{ $version->created_at->format('d M Y H:i') }}<br>
                                                                </div>
                                                            </div>
                                                            @if ($version->changelog)
                                                                <hr>
                                                                <strong>Changelog:</strong>
                                                                <div class="mt-2">
                                                                    @foreach ($version->changelog_array as $change)
                                                                        <p class="mb-1">• {{ $change }}</p>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            @if ($version->download_url)
                                                                <hr>
                                                                <strong>Download URL:</strong><br>
                                                                <code>{{ $version->full_download_url }}</code>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Modal Edit --}}
                                            <div class="modal fade" id="editModal{{ $version->id }}" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Version {{ $version->version }}
                                                                ({{ $version->version_code }})
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('app-version.update', $version->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Versi Saat Ini</label>
                                                                            <input type="text" class="form-control"
                                                                                value="{{ $version->version }}" readonly>
                                                                            <small class="form-text text-muted">Versi tidak
                                                                                bisa diubah</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label>Version Code Saat Ini</label>
                                                                            <input type="number" class="form-control"
                                                                                value="{{ $version->version_code }}"
                                                                                readonly>
                                                                            <small class="form-text text-muted">Version
                                                                                code tidak bisa diubah</small>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="minimum_version_edit">Versi
                                                                                Minimum</label>
                                                                            <input type="text" class="form-control"
                                                                                name="minimum_version"
                                                                                value="{{ $version->minimum_version }}"
                                                                                placeholder="contoh: 1.1">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="minimum_version_code_edit">Minimum
                                                                                Version Code</label>
                                                                            <input type="number" class="form-control"
                                                                                name="minimum_version_code"
                                                                                value="{{ $version->minimum_version_code }}"
                                                                                placeholder="Contoh: 10100">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="apk_file_edit">File APK Baru
                                                                        (Opsional)</label>
                                                                    <input type="file" class="form-control-file"
                                                                        name="apk_file" accept=".apk">
                                                                    <small class="form-text text-muted">Kosongkan jika
                                                                        tidak ingin mengubah file APK</small>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="is_force_update" value="1"
                                                                            {{ $version->is_force_update ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Force Update (Wajib
                                                                            Update)</label>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="is_active" value="1"
                                                                            {{ $version->is_active ? 'checked' : '' }}>
                                                                        <label class="form-check-label">Aktif</label>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="changelog_edit">Changelog</label>
                                                                    <textarea class="form-control" name="changelog" rows="4" placeholder="- Fitur baru A&#10;- Perbaikan bug B">{{ $version->changelog }}</textarea>
                                                                </div>

                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="fas fa-save"></i> Simpan Perubahan
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Modal Konfirmasi Hapus --}}
                                            <div class="modal fade" id="deleteModal{{ $version->id }}" tabindex="-1"
                                                role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus Version
                                                            <strong>{{ $version->version }}</strong>
                                                            ({{ $version->version_code }})?
                                                            <br><small class="text-danger">File APK juga akan terhapus dari
                                                                server!</small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <form
                                                                action="{{ route('app-version.destroy', $version->id) }}"
                                                                method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    <i class="fas fa-trash"></i> Ya, Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">
                                                    <p class="text-muted">Belum ada data versi aplikasi</p>
                                                </td>
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
