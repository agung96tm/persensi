@extends('layouts.app')

@section('title', 'Kehadiran Saya')
@section('page-title', 'Kehadiran Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-calendar-check me-2"></i>Status Kehadiran
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
                                    <th>Sesi</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
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
                                @forelse($sessions as $session)
                                    @php
                                        $attendance = $attendanceBySession[$session->id] ?? null;
                                        $status = $attendance?->status;
                                    @endphp
                                    <tr>
                                        <td>{{ $session->nama_sesi }}</td>
                                        <td>{{ $session->tanggal?->format('d/m/Y') ?? '-' }}</td>
                                        <td>
                                            {{ $session->jam_mulai?->format('H:i') ?? '-' }} -
                                            {{ $session->jam_selesai?->format('H:i') ?? '-' }}
                                        </td>
                                        <td>
                                            <span class="badge {{ $statusClasses[$status] ?? 'bg-secondary' }}">
                                                {{ $status ? strtoupper($status) : 'BELUM ABSEN' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                            Belum ada sesi untuk hari ini
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
