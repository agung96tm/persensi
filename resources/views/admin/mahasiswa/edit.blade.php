@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Mahasiswa</div>
    <div class="card-body">

        <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->id) }}">
            @csrf
            @method('PUT')

            <input name="nama" class="form-control mb-2"
                   value="{{ old('nama', $mahasiswa->nama) }}"
                   placeholder="Nama Mahasiswa">

            <input name="nim" class="form-control mb-2"
                   value="{{ old('nim', $mahasiswa->nim) }}"
                   placeholder="NIM">

            <input name="no_kartu" class="form-control mb-2"
                   value="{{ old('no_kartu', $mahasiswa->no_kartu) }}"
                   placeholder="No Kartu RFID">

            <input name="kelas" class="form-control mb-2"
                   value="{{ old('kelas', $mahasiswa->kelas) }}"
                   placeholder="Kelas">

            <select name="user_id" class="form-control mb-3">
                <option value="">-- Tidak punya akun --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}"
                        {{ $mahasiswa->user_id == $u->id ? 'selected' : '' }}>
                        {{ $u->name }}
                    </option>
                @endforeach
            </select>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>

        </form>

    </div>
</div>
@endsection
