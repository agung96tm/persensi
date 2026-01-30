@extends('layouts.app')

@section('title', 'Profil')
@section('page-title', 'Profil')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-person-circle me-2"></i>Informasi Profil
                </h5>
            </div>
            <div class="card-body">
                @if(!$mahasiswa)
                    <div class="alert alert-warning">
                        Data mahasiswa belum terhubung ke akun Anda.
                    </div>
                @endif
                <p class="mb-2">
                    <strong>Nama:</strong><br>
                    <span class="text-muted">{{ auth()->user()->name }}</span>
                </p>
                <p class="mb-2">
                    <strong>Email:</strong><br>
                    <span class="text-muted">{{ auth()->user()->email }}</span>
                </p>
                <p class="mb-2">
                    <strong>NIM:</strong><br>
                    <span class="text-muted">{{ $mahasiswa?->nim ?? '-' }}</span>
                </p>
                <p class="mb-2">
                    <strong>Kelas:</strong><br>
                    <span class="text-muted">{{ $mahasiswa?->kelas ?? '-' }}</span>
                </p>
                <p class="mb-2">
                    <strong>No. Kartu:</strong><br>
                    <span class="text-muted">{{ $mahasiswa?->no_kartu ?? '-' }}</span>
                </p>
                <p class="mb-0">
                    <strong>Bergabung:</strong><br>
                    <span class="text-muted">{{ auth()->user()->created_at->format('d M Y') }}</span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
