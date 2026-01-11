@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Users</div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf @method('PUT')
            <input name="name" value="{{ $user->name }}" class="form-control mb-2">
            <input name="email" value="{{ $user->email }}" class="form-control mb-2">
            <div class="d-flex gap-2">
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
