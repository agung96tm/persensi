@extends('layouts.app')

@section('title', 'Tambah Mahasiswa')
@section('page-title', 'Tambah Mahasiswa')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-person-plus me-2"></i>Tambah Mahasiswa Baru
        </h5>
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="bi bi-file-earmark-excel me-1"></i> Import Excel
        </button>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('mahasiswa.store') }}">
            @csrf

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="nama" class="form-label fw-bold">
                        <i class="bi bi-person me-1 text-primary"></i>Nama Lengkap 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control form-control-lg @error('nama') is-invalid @enderror" 
                        id="nama" 
                        name="nama" 
                        placeholder="Contoh: Ahmad Fauzi" 
                        value="{{ old('nama') }}" 
                        required
                        autofocus
                    >
                    @error('nama')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">
                        <i class="bi bi-info-circle me-1"></i>Nama lengkap mahasiswa
                    </small>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="nim" class="form-label fw-bold">
                        <i class="bi bi-card-text me-1 text-primary"></i>NIM 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control form-control-lg @error('nim') is-invalid @enderror" 
                        id="nim" 
                        name="nim" 
                        placeholder="Contoh: 202410001" 
                        value="{{ old('nim') }}" 
                        required
                    >
                    @error('nim')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">
                        <i class="bi bi-info-circle me-1"></i>Nomor Induk Mahasiswa (harus unik)
                    </small>
                </div>

                <div class="col-md-6">
                    <label for="no_kartu" class="form-label fw-bold">
                        <i class="bi bi-credit-card me-1 text-primary"></i>UID RFID 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control form-control-lg @error('no_kartu') is-invalid @enderror" 
                        id="no_kartu" 
                        name="no_kartu" 
                        placeholder="Contoh: 04A1B2C3D4" 
                        value="{{ old('no_kartu') }}" 
                        required
                    >
                    @error('no_kartu')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">
                        <i class="bi bi-info-circle me-1"></i>Nomor kartu RFID untuk absensi
                    </small>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="kelas" class="form-label fw-bold">
                        <i class="bi bi-building me-1 text-primary"></i>Kelas 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        class="form-control form-control-lg @error('kelas') is-invalid @enderror" 
                        id="kelas" 
                        name="kelas" 
                        placeholder="Contoh: AA" 
                        value="{{ old('kelas') }}" 
                        maxlength="2"
                        style="text-transform: uppercase"
                        required
                    >
                    @error('kelas')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">
                        <i class="bi bi-info-circle me-1"></i>Kode kelas (maksimal 2 karakter)
                    </small>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label fw-bold">
                        <i class="bi bi-envelope me-1 text-primary"></i>Email
                    </label>
                    <input 
                        type="email" 
                        class="form-control form-control-lg @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        placeholder="Contoh: ahmad.fauzi@email.com" 
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted d-block">
                        <i class="bi bi-info-circle me-1"></i>Kosongkan untuk menggunakan email default
                        <br>
                        <small class="text-muted ms-4">(NIM@student.budiluhur.ac.id)</small>
                    </small>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-lg">
                    <i class="bi bi-arrow-left me-2"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-circle me-2"></i>Simpan Mahasiswa
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('mahasiswa.import') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="importModalLabel">
                        <i class="bi bi-file-earmark-excel me-2"></i>Import Data Mahasiswa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Format Excel:</strong> nama | nim | no_kartu | kelas | email
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label fw-bold">Pilih File Excel</label>
                        <input 
                            type="file" 
                            name="file" 
                            id="file"
                            class="form-control form-control-lg" 
                            accept=".xlsx,.xls,.csv"
                            required
                        >
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle me-1"></i>Format: .xlsx, .xls, atau .csv (Maks. 5MB)
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-upload me-1"></i>Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
