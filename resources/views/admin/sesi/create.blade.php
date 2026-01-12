@extends('layouts.app')

@section('title','Tambah Sesi')
@section('page-title','Tambah Sesi Presensi')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-plus-circle me-2"></i>Tambah Sesi Presensi
        </h5>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.sesi.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Sesi</label>
                <input type="text" name="nama_sesi" class="form-control" required
                       placeholder="Contoh: Presensi Matakuliah IoT">
            </div>

            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <input type="text" name="kelas" class="form-control" required
                       placeholder="AA">
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.sesi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Batal
                </a>
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan & Aktifkan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
