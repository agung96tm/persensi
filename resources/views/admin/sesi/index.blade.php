@extends('layouts.app')

@section('title','Sesi Presensi')
@section('page-title','Sesi Presensi')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-calendar-check me-2"></i>Daftar Sesi Presensi
        </h5>
        <a href="{{ route('admin.sesi.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Tambah Sesi
        </a>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Sesi</th>
                    <th>Kelas</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sesi as $item)
                <tr class="text-center">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_sesi }}</td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                    <td>
                        @if($item->status == 'aktif')
                            <span class="badge bg-success">AKTIF</span>
                        @else
                            <span class="badge bg-secondary">SELESAI</span>
                        @endif
                    </td>
                    <td>
                        @if($item->status == 'aktif')
                        <form action="{{ route('admin.sesi.selesai',$item->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-x-circle"></i> Tutup
                            </button>
                        </form>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada sesi presensi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
