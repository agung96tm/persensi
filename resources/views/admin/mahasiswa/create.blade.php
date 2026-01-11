@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Mahasiswa</div>
    <div class="card-body">
        <form method="POST" action="{{ route('mahasiswa.store') }}">
            @csrf

            <select name="user_id" class="form-control mb-2">
                <option value="">-- Pilih User --</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                @endforeach
            </select>

            <input name="nim" class="form-control mb-2" placeholder="NIM">
            <input name="no_kartu" class="form-control mb-2" placeholder="UID RFID">
            <input name="kelas" class="form-control mb-2" placeholder="AA">

            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
