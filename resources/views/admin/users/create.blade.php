@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Tambah Users</div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <input name="name" class="form-control mb-2" placeholder="Nama">
            <input name="email" class="form-control mb-2" placeholder="Email">
            <input name="password" type="password" class="form-control mb-2" placeholder="Password">
            <div class="d-flex gap-2">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
