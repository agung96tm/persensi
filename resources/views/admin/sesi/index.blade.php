@extends('layouts.app')

@section('title', 'Sesi Presensi')
@section('page-title', 'Sesi Presensi')

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
        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-8">
                <form method="GET" action="{{ route('admin.sesi.index') }}" class="d-flex gap-2">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Cari nama sesi atau kelas..." 
                        value="{{ request('search') }}"
                    >
                    <select name="status" class="form-select" style="width: auto;">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i>
                    </button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('admin.sesi.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    @endif
                </form>
            </div>
            <div class="col-md-4 text-end">
                <small class="text-muted">
                    Total: <strong>{{ $sesi->total() }}</strong> sesi
                </small>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th style="width: 50px">No</th>
                        <th>Nama Sesi</th>
                        <th style="width: 80px">Kelas</th>
                        <th style="width: 120px">Tanggal</th>
                        <th style="width: 150px">Jam</th>
                        <th style="width: 100px">Status</th>
                        <th style="width: 220px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sesi as $item)
                    <tr>
                        <td class="text-center">{{ $sesi->firstItem() + $loop->index }}</td>
                        <td>
                            <i class="bi bi-calendar3 me-2 text-primary"></i>
                            <strong>{{ $item->nama_sesi }}</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary">{{ $item->kelas }}</span>
                        </td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                        </td>
                        <td class="text-center">
                            <small>
                                <i class="bi bi-clock me-1"></i>
                                {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}
                            </small>
                        </td>
                        <td class="text-center">
                            @if($item->status == 'aktif')
                                <span class="badge bg-success fs-6">
                                    <i class="bi bi-check-circle me-1"></i>AKTIF
                                </span>
                            @else
                                <span class="badge bg-secondary fs-6">
                                    <i class="bi bi-x-circle me-1"></i>SELESAI
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('admin.kehadiran.index', $item->id) }}"
                                   class="btn btn-sm btn-info" 
                                   title="Lihat Kehadiran">
                                    <i class="bi bi-people me-1"></i>Kehadiran
                                </a>
                                
                                @if($item->status == 'aktif')
                                    <a href="{{ route('admin.sesi.edit', $item->id) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.sesi.selesai', $item->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menutup sesi ini?')">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger"
                                                title="Tutup Sesi">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin.sesi.edit', $item->id) }}"
                                       class="btn btn-sm btn-outline-secondary"
                                       title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                <p class="mb-0">Tidak ada data sesi</p>
                                @if(request('search') || request('status'))
                                    <small>Coba gunakan filter lain atau <a href="{{ route('admin.sesi.index') }}">reset pencarian</a></small>
                                @else
                                    <small><a href="{{ route('admin.sesi.create') }}">Tambah sesi pertama</a></small>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($sesi->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $sesi->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
