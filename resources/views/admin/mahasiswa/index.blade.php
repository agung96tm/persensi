@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5>Data Mahasiswa</h5>
        <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Tambah</a>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Kelas</th>
                <th>RFID</th>
                <th>Aksi</th>
            </tr>
            @foreach($mahasiswa as $m)
            <tr>
                <td>{{ $m->user?->name ?? $m->nama }}</td>
                <td>{{ $m->nim }}</td>
                <td>{{ $m->kelas }}</td>
                <td>{{ $m->no_kartu }}</td>
                <td>
                    <a href="{{ route('mahasiswa.edit',$m->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('mahasiswa.destroy',$m->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
