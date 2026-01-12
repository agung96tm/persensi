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

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">
                        <i class="bi bi-person me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('nama') is-invalid @enderror"
                        name="nama"
                        value="{{ old('nama', $mahasiswa->nama) }}"
                        required
                    >
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="bi bi-card-text me-1"></i>NIM <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('nim') is-invalid @enderror"
                        name="nim"
                        value="{{ old('nim', $mahasiswa->nim) }}"
                        required
                    >
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="bi bi-credit-card me-1"></i>UID RFID <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('no_kartu') is-invalid @enderror"
                        name="no_kartu"
                        value="{{ old('no_kartu', $mahasiswa->no_kartu) }}"
                        required
                    >
                    @error('no_kartu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="bi bi-building me-1"></i>Kelas <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        class="form-control @error('kelas') is-invalid @enderror"
                        name="kelas"
                        maxlength="2"
                        value="{{ old('kelas', $mahasiswa->kelas) }}"
                        required
                    >
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">
                        <i class="bi bi-envelope me-1"></i>Email Akun
                    </label>
                    <input
                        type="email"
                        class="form-control"
                        value="{{ $mahasiswa->user->email ?? '-' }}"
                        disabled
                    >
                    <small class="text-muted">
                        Email tidak dapat diubah dari menu mahasiswa
                    </small>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
