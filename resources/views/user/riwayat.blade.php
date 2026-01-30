@extends('layouts.app')

@section('title', 'Riwayat Kehadiran')
@section('page-title', 'Riwayat Kehadiran')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2"></i>Riwayat Kehadiran
                </h5>
            </div>
            <div class="card-body">
                @if(!$mahasiswa)
                    <div class="alert alert-warning mb-0">
                        Data mahasiswa belum terhubung ke akun Anda.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Waktu Masuk</th>
                                    <th>Waktu Keluar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $statusClasses = [
                                        'hadir' => 'bg-success',
                                        'terlambat' => 'bg-warning text-dark',
                                        'izin' => 'bg-info text-dark',
                                        'sakit' => 'bg-secondary',
                                        'alpha' => 'bg-danger',
                                    ];
                                @endphp
                                @forelse($riwayat as $attendance)
                                    <tr>
                                        <td>{{ $attendance->sesi?->tanggal?->format('d/m/Y') ?? '-' }}</td>
                                        <td>{{ $attendance->waktu_hadir?->format('H:i') ?? '-' }}</td>
                                        <td>{{ $attendance->waktu_keluar?->format('H:i') ?? '-' }}</td>
                                        <td>
                                            <span class="badge {{ $statusClasses[$attendance->status] ?? 'bg-secondary' }}">
                                                {{ strtoupper($attendance->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            Belum ada riwayat kehadiran
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($riwayat->hasPages())
                        <div class="mt-3">
                            {{ $riwayat->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
