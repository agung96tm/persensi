@extends('layouts.app')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-pencil-square me-2"></i>Edit User
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="name" class="form-label fw-bold">
                        <i class="bi bi-person me-1 text-primary"></i>Nama 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name"
                        class="form-control form-control-lg @error('name') is-invalid @enderror" 
                        name="name" 
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                    >
                    @error('name')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="email" class="form-label fw-bold">
                        <i class="bi bi-envelope me-1 text-primary"></i>Email 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            @if($user->mahasiswa)
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                <strong>Data Mahasiswa:</strong> 
                NIM: <strong>{{ $user->mahasiswa->nim }}</strong> | 
                Kelas: <strong>{{ $user->mahasiswa->kelas }}</strong> | 
                RFID: <strong>{{ $user->mahasiswa->no_kartu }}</strong>
                <br>
                <small>Untuk mengubah data mahasiswa, edit melalui menu <a href="{{ route('mahasiswa.edit', $user->mahasiswa->id) }}">Data Mahasiswa</a></small>
            </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="password" class="form-label fw-bold">
                        <i class="bi bi-lock me-1 text-primary"></i>Password Baru
                    </label>
                    <input 
                        type="password" 
                        id="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror" 
                        name="password" 
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                    >
                    @error('password')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    <small class="form-text text-muted">
                        <i class="bi bi-info-circle me-1"></i>Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.
                    </small>
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-lg">
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
