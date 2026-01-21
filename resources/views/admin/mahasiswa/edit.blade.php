@extends('layouts.app')

@section('title', 'Edit Mahasiswa')
@section('page-title', 'Edit Mahasiswa')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-pencil-square me-2"></i>Edit Data Mahasiswa
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->id) }}">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="nama" class="form-label fw-bold">
                        <i class="bi bi-person me-1 text-primary"></i>Nama Lengkap 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama"
                        class="form-control form-control-lg @error('nama') is-invalid @enderror" 
                        name="nama" 
                        value="{{ old('nama', $mahasiswa->nama) }}"
                        required
                        autofocus
                    >
                    @error('nama')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
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
                        id="nim"
                        class="form-control form-control-lg @error('nim') is-invalid @enderror" 
                        name="nim" 
                        value="{{ old('nim', $mahasiswa->nim) }}"
                        required
                    >
                    @error('nim')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="no_kartu" class="form-label fw-bold">
                        <i class="bi bi-credit-card me-1 text-primary"></i>UID RFID 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="no_kartu"
                        class="form-control form-control-lg @error('no_kartu') is-invalid @enderror" 
                        name="no_kartu" 
                        value="{{ old('no_kartu', $mahasiswa->no_kartu) }}"
                        required
                    >
                    @error('no_kartu')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
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
                        id="kelas"
                        class="form-control form-control-lg @error('kelas') is-invalid @enderror" 
                        name="kelas" 
                        maxlength="2"
                        style="text-transform: uppercase"
                        value="{{ old('kelas', $mahasiswa->kelas) }}"
                        required
                    >
                    @error('kelas')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label fw-bold">
                        <i class="bi bi-envelope me-1 text-primary"></i>Email Akun
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        class="form-control form-control-lg" 
                        value="{{ $mahasiswa->user->email ?? '-' }}"
                        disabled
                    >
                    <small class="form-text text-muted">
                        <i class="bi bi-info-circle me-1"></i>Email tidak dapat diubah dari menu mahasiswa
                    </small>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary btn-lg">
                    <i class="bi bi-arrow-left me-2"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
