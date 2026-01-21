@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('page-title', 'Data Mahasiswa')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-mortarboard me-2"></i>Data Mahasiswa
        </h5>
        <div class="d-flex gap-2">
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Tambah Mahasiswa
            </a>
        </div>
    </div>

    <div class="card-body">
        <!-- Search & Filter -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('mahasiswa.index') }}" class="d-flex gap-2">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Cari NIM, Nama, Kelas, atau RFID..." 
                        value="{{ request('search') }}"
                    >
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i>
                        </a>
                    @endif
                </form>
            </div>
            <div class="col-md-6 text-end">
                <small class="text-muted">
                    Total: <strong>{{ $mahasiswa->total() }}</strong> mahasiswa
                </small>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th style="width: 50px">No</th>
                        <th>Nama Lengkap</th>
                        <th>NIM</th>
                        <th style="width: 80px">Kelas</th>
                        <th>UID RFID</th>
                        <th>Email</th>
                        <th style="width: 180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $m)
                    <tr>
                        <td class="text-center">{{ $mahasiswa->firstItem() + $loop->index }}</td>
                        <td>
                            <i class="bi bi-person-circle me-2 text-primary"></i>
                            <strong>{{ $m->user?->name ?? $m->nama }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $m->nim }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary">{{ $m->kelas }}</span>
                        </td>
                        <td>
                            <code class="text-primary">{{ $m->no_kartu }}</code>
                        </td>
                        <td>
                            <small class="text-muted">{{ $m->user?->email ?? '-' }}</small>
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('mahasiswa.edit', $m->id) }}" 
                                   class="btn btn-sm btn-warning" 
                                   title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('mahasiswa.destroy', $m->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger" 
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                <p class="mb-0">Tidak ada data mahasiswa</p>
                                @if(request('search'))
                                    <small>Coba gunakan kata kunci lain atau <a href="{{ route('mahasiswa.index') }}">reset pencarian</a></small>
                                @else
                                    <small><a href="{{ route('mahasiswa.create') }}">Tambah mahasiswa pertama</a></small>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($mahasiswa->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $mahasiswa->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
