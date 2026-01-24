@extends('layouts.app')

@section('title', 'Edit Sesi')
@section('page-title', 'Edit Sesi Presensi')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-pencil-square me-2"></i>Edit Sesi Presensi
        </h5>
        @if($sesi->status == 'aktif')
            <span class="badge bg-success fs-6">
                <i class="bi bi-check-circle me-1"></i>AKTIF
            </span>
        @else
            <span class="badge bg-secondary fs-6">
                <i class="bi bi-x-circle me-1"></i>SELESAI
            </span>
        @endif
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.sesi.update', $sesi->id) }}">
            @csrf
            @method('PUT')

            <div class="row mb-4">
                <div class="col-md-12">
                    <label for="nama_sesi" class="form-label fw-bold">
                        <i class="bi bi-calendar3 me-1 text-primary"></i>Nama Sesi 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nama_sesi"
                        name="nama_sesi" 
                        class="form-control form-control-lg @error('nama_sesi') is-invalid @enderror" 
                        placeholder="Contoh: Presensi Matakuliah IoT"
                        value="{{ old('nama_sesi', $sesi->nama_sesi) }}"
                        required
                        autofocus
                    >
                    @error('nama_sesi')
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
                        name="kelas" 
                        class="form-control form-control-lg @error('kelas') is-invalid @enderror" 
                        placeholder="Contoh: AA"
                        value="{{ old('kelas', $sesi->kelas) }}"
                        maxlength="2"
                        style="text-transform: uppercase"
                        required
                    >
                    @error('kelas')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    @if($sesi->status == 'aktif')
                        <small class="form-text text-warning d-block">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Jika kelas diubah, sesi aktif di kelas baru akan otomatis ditutup
                        </small>
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="tanggal" class="form-label fw-bold">
                        <i class="bi bi-calendar-date me-1 text-primary"></i>Tanggal 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="tanggal"
                        name="tanggal" 
                        class="form-control form-control-lg @error('tanggal') is-invalid @enderror" 
                        value="{{ old('tanggal', $sesi->tanggal->format('Y-m-d')) }}"
                        required
                    >
                    @error('tanggal')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="jam_mulai" class="form-label fw-bold">
                        <i class="bi bi-clock me-1 text-primary"></i>Jam Mulai 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="time" 
                        id="jam_mulai"
                        name="jam_mulai" 
                        class="form-control form-control-lg @error('jam_mulai') is-invalid @enderror" 
                        value="{{ old('jam_mulai', \Carbon\Carbon::parse($sesi->jam_mulai)->format('H:i')) }}"
                        required
                    >
                    @error('jam_mulai')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="jam_selesai" class="form-label fw-bold">
                        <i class="bi bi-clock-history me-1 text-primary"></i>Jam Selesai 
                        <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="time" 
                        id="jam_selesai"
                        name="jam_selesai" 
                        class="form-control form-control-lg @error('jam_selesai') is-invalid @enderror" 
                        value="{{ old('jam_selesai', \Carbon\Carbon::parse($sesi->jam_selesai)->format('H:i')) }}"
                        required
                    >
                    @error('jam_selesai')
                        <div class="invalid-feedback">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            @if($sesi->kehadiran()->count() > 0)
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Sesi ini sudah memiliki <strong>{{ $sesi->kehadiran()->count() }}</strong> data kehadiran.
                </div>
            @endif

            <hr class="my-4">

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.sesi.index') }}" class="btn btn-secondary btn-lg">
                    <i class="bi bi-arrow-left me-2"></i>Batal
                </a>
                <div class="d-flex gap-2">
                    @if($sesi->kehadiran()->count() == 0)
                        <form action="{{ route('admin.sesi.destroy', $sesi->id) }}" 
                              method="POST" 
                              class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus sesi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg">
                                <i class="bi bi-trash me-2"></i>Hapus
                            </button>
                        </form>
                    @endif
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-save me-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
