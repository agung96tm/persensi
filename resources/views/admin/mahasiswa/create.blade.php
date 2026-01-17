@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')
@section('page-title', 'Tambah Mahasiswa')

@section('content')
<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">
        <i class="bi bi-person-plus me-2"></i>Tambah Mahasiswa Baru
    </h5>

    <!-- Tombol Import -->
    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
        <i class="bi bi-file-earmark-excel me-1"></i> Import Excel
    </button>
</div>
    <div class="card-body">
        <form method="POST" action="{{ route('mahasiswa.store') }}">
            @csrf

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="nama" class="form-label">
                        <i class="bi bi-person me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('nama') is-invalid @enderror" 
                        id="nama" 
                        name="nama" 
                        placeholder="Contoh: Ahmad Fauzi" 
                        value="{{ old('nama') }}" 
                        required
                    >
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">Nama lengkap mahasiswa</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nim" class="form-label">
                        <i class="bi bi-card-text me-1"></i>NIM <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('nim') is-invalid @enderror" 
                        id="nim" 
                        name="nim" 
                        placeholder="Contoh: 202410001" 
                        value="{{ old('nim') }}" 
                        required
                    >
                    @error('nim')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">Nomor Induk Mahasiswa (harus unik)</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="no_kartu" class="form-label">
                        <i class="bi bi-credit-card me-1"></i>UID RFID <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('no_kartu') is-invalid @enderror" 
                        id="no_kartu" 
                        name="no_kartu" 
                        placeholder="Contoh: 04A1B2C3D4" 
                        value="{{ old('no_kartu') }}" 
                        required
                    >
                    @error('no_kartu')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">Nomor kartu RFID untuk absensi</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kelas" class="form-label">
                        <i class="bi bi-building me-1"></i>Kelas <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('kelas') is-invalid @enderror" 
                        id="kelas" 
                        name="kelas" 
                        placeholder="Contoh: AA" 
                        value="{{ old('kelas') }}" 
                        maxlength="2"
                        required
                    >
                    @error('kelas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">Kode kelas (maksimal 2 karakter)</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope me-1"></i>Email
                    </label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        placeholder="Contoh: ahmad.fauzi@email.com" 
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">Kosongkan untuk menggunakan email default (NIM@student.budiluhur.ac.id)</small>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Simpan Mahasiswa
                </button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="importModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" 
                  action="{{ route('mahasiswa.import') }}" 
                  enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-file-earmark-excel me-2"></i>Import Data Mahasiswa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">File Excel</label>
                        <input type="file" 
                               name="file" 
                               class="form-control" 
                               accept=".xlsx,.xls,.csv"
                               required>
                        <small class="text-muted">
                            Format: nama | nim | no_kartu | kelas | email
                        </small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload me-1"></i> Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection